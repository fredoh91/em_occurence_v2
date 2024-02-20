<?php

namespace App\Controller;

use App\Entity\EmRomediV2;
use App\Entity\EmDenomMapV2;
use App\Entity\EmDenomMapTodoV2;
use App\Form\ModifTodoListeType;
use App\Entity\EmDenomMapCategoV2;
use Doctrine\ORM\EntityManagerInterface;
use App\MsAccess\Database\DatabaseAccess;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TrtReliquatTxtMiningController extends AbstractController
{
    private $nb_propositions = 5;
    private $nb_lignes_traitees = 30;

     /**
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return Response
     */
    #[Route(path: '/trt_reliquat_txt_mining_update', name: 'trt_reliquat_txt_mining_update')]
    public function listeReliquat_txt_mining_update(Request $request, EntityManagerInterface $em)
    {
        if (!empty($_POST)){
            set_time_limit(360);
            foreach( $_POST as $k => $v ) {
                  if (strpos($k, 'Denomination_') !== FALSE) {
//                        $id_denom_map_todo = intval (substr ($k , 13));
                      $id_denom_map_todo = substr ($k , 13);

                      if (isset($_POST['id_'.$id_denom_map_todo])) {

                        $repo = $em->getRepository(EmDenomMapTodoV2::class);
                        $reliquat = $repo->find(intval ($id_denom_map_todo));

                        // Recherche de la catégorie
                        $id_catego = intval ($_POST['Categorie_'.$id_denom_map_todo]);
                        $repo_catego = $em->getRepository(EmDenomMapCategoV2::class);
                        $catego = $repo_catego->find($id_catego);

                        // Ajout d'une ligne dans EmDenomMapV2
                        $denomMap=new EmDenomMapV2;
                        $denomMap->setDenomination($_POST['Denomination_'.$id_denom_map_todo]);
                        $denomMap->setBNLabel($_POST['BN_Label_'.$id_denom_map_todo]);
                        $denomMap->setLabel($_POST['Label_'.$id_denom_map_todo]);
                        $denomMap->setCIS($_POST['CIS_'.$id_denom_map_todo]);
                        $denomMap->setATC7($_POST['ATC7_'.$id_denom_map_todo]);
                        $denomMap->setCategorie($catego);
                        $denomMap->setCQ("1");

                        $em->persist($denomMap);

                        // Effacement de la ligne dans EmDenomMapTodoV2
                        $em->remove($reliquat);

                        $em->flush();                            
                    }
                }
            }
        }

        // redirection vers la route liste_reliquat , la liste des EM à mapper
        return $this->redirectToRoute('trt_reliquat_txt_mining');
    }


     /**
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return Response
     */
    #[Route(path: '/trt_todo_list_reliquat_txt_mining', name: 'trt_todo_list_reliquat_txt_mining')]
    public function trt_todo_list_reliquat_txt_mining(Request $request, EntityManagerInterface $em):Response
    {
        
        if (!empty($_POST)){
//            dd($_POST);
            $repo_todo = $em->getRepository(EmDenomMapTodoV2::class);
            $repo_map = $em->getRepository(EmDenomMapV2::class);
            $repo_romedi = $em->getRepository(EmRomediV2::class);
                
            $todos = array();
            $i=0;
            foreach($_POST as $post){
                
                $id_denom_map_todo = intval (substr($post,0,6));
                $id_Romedi = intval (substr($post,7,6));
                $id_denom_map = intval (substr($post,14,6));
                $lev = intval (substr($post,21,6));
                $TypeTxtMining = substr($post,28,1);
//                $lev = Levenshtein;
                
                $denom_map_todo = $repo_todo->find($id_denom_map_todo);
                
                if ($id_Romedi !== 0) {
                    $romedis = $repo_romedi->find($id_Romedi);
//                    dump($romedis);
                    $todos[$i]['id']= $id_denom_map_todo;
                    $todos[$i]['Denomination']= $denom_map_todo->getDenomination();
                    $todos[$i]['Nbr']= $denom_map_todo->getNbr();
                    $todos[$i]['CIS']= $romedis->getCIS();
                    $todos[$i]['Label']= $romedis->getLabel();
                    $todos[$i]['BN_Label']= $romedis->getBNLabelRomedi();
                    $todos[$i]['ATC7']= $romedis->getATC7();
                    $todos[$i]['Levenshtein']= $lev;
                    $i++;
                } else if ($id_denom_map !== 0) {
                    $denom_maps = $repo_map->find($id_denom_map);
//                    dump($denom_maps);
                    $todos[$i]['id']= $id_denom_map_todo;
                    $todos[$i]['Denomination']= $denom_map_todo->getDenomination();
                    $todos[$i]['Nbr']= $denom_map_todo->getNbr();
                    $todos[$i]['CIS']= $denom_maps->getCIS();
                    $todos[$i]['Label']= $denom_maps->getLabel();
                    $todos[$i]['BN_Label']= $denom_maps->getBNLabel();
                    $todos[$i]['ATC7']= $denom_maps->getATC7();
                    $todos[$i]['Levenshtein']= $lev;
                    $i++;
                }
            } 

        return $this->render('trt_reliquat_txt_mining/valid_modif_txt_mining.html.twig', [
            'todos' => $todos
        ]);          
        } else {

            
//            // Message flash pour avertir l'utilisateur
//            $this->addFlash('alert', 'Merci de selectionner une ou plusieurs lignes à mapper');

            // redirection vers la route liste_reliquat , la liste des EM à mapper
            return $this->redirectToRoute('trt_reliquat_txt_mining');
        }

    }
    
     /**
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return Response
     */
    #[Route(path: '/trt_reliquat_txt_mining', name: 'trt_reliquat_txt_mining')]
    public function listeReliquat_txt_mining_levenshtein(Request $request, EntityManagerInterface $em):Response
    {
        
        set_time_limit(360);
        
        $ObjAccess = new DatabaseAccess();

        $repo_todo = $em->getRepository(EmDenomMapTodoV2::class);
        $todos = $repo_todo->findAll();
                
        $repo_map = $em->getRepository(EmDenomMapV2::class);
        $denom_maps = $repo_map->findAll();

        $repo_romedi = $em->getRepository(EmRomediV2::class);
        $romedis = $repo_romedi->findAll();
        $k1 = 0;
        
        $mapping = array();
        
        foreach ($todos as $todo) {
            $mapping_tempo_Romlabel = array();
            $mapping_tempo_Rombn_label = array();
            $mapping_tempo_Maplabel = array();
            $mapping_tempo_Mapbn_label = array();
            $denom_to_find = $todo->getdenomination();
            $denom_lst_numBNPV =  $ObjAccess->DonneListe_numBNPV($denom_to_find);
            $id_denom_map_todo = $todo->getId();
//            Recherche dans ROMEDI
            $k2=0;

            foreach($romedis  as $romedi) {
                 $BNLabel_Romedi =$romedi->getBNLabelRomedi();               
                
//               est ce qu'on retrouve le BN_Label Romedi dans le todo.denomination
                if (strpos($denom_to_find, $BNLabel_Romedi) !== FALSE) {
//                    on retrouve le BN_Label Romedi dans le todo.denomination
                    $k2++;
                    $id_Romedi =$romedi->getId();
                    $Label_Romedi =$romedi->getLabel();
                    $CIS_Romedi =$romedi->getCIS();
                    $ATC7_Romedi =$romedi->getATC7();
                    $levBNl = levenshtein($denom_to_find, $BNLabel_Romedi);
                    $levLab = levenshtein($denom_to_find, $Label_Romedi);

                    $mapping_tempo_Romlabel[$k2]['Denomination']=$denom_to_find;
                    $mapping_tempo_Romlabel[$k2]['LstNumBNPV']=$denom_lst_numBNPV;
                    $mapping_tempo_Romlabel[$k2]['BNLabel']=$BNLabel_Romedi;
                    $mapping_tempo_Romlabel[$k2]['Levenshtein']=$levLab;
                    $mapping_tempo_Romlabel[$k2]['id_denom_map_todo']=$id_denom_map_todo;
                    $mapping_tempo_Romlabel[$k2]['id_denom_map']=null;
                    $mapping_tempo_Romlabel[$k2]['id_Romedi']=$id_Romedi;
                    $mapping_tempo_Romlabel[$k2]['Label']=$Label_Romedi;
                    $mapping_tempo_Romlabel[$k2]['CIS']=$CIS_Romedi;
                    $mapping_tempo_Romlabel[$k2]['ATC7']=$ATC7_Romedi;
                    $mapping_tempo_Romlabel[$k2]['TypeTxtMining']='1_Rom_Lab';
                    
                    $mapping_tempo_Rombn_label[$k2]['Denomination']=$denom_to_find;
                    $mapping_tempo_Rombn_label[$k2]['LstNumBNPV']=$denom_lst_numBNPV;
                    $mapping_tempo_Rombn_label[$k2]['BNLabel']=$BNLabel_Romedi;
                    $mapping_tempo_Rombn_label[$k2]['Levenshtein']=$levBNl;
                    $mapping_tempo_Rombn_label[$k2]['id_denom_map_todo']=$id_denom_map_todo;
                    $mapping_tempo_Rombn_label[$k2]['id_denom_map']=null;
                    $mapping_tempo_Rombn_label[$k2]['id_Romedi']=$id_Romedi;
                    $mapping_tempo_Rombn_label[$k2]['Label']=$Label_Romedi;
                    $mapping_tempo_Rombn_label[$k2]['CIS']=$CIS_Romedi;
                    $mapping_tempo_Rombn_label[$k2]['ATC7']=$ATC7_Romedi;
                    $mapping_tempo_Rombn_label[$k2]['TypeTxtMining']='3_Rom_BNl';
                }
            }
            
            // tri ascendant du tableau selon la distance de Levenshtein, les plus proches seront en premier        
            $columns = array_column($mapping_tempo_Romlabel, 'Levenshtein');
            array_multisort($columns, SORT_ASC, $mapping_tempo_Romlabel);   
            
            // tri ascendant du tableau selon la distance de Levenshtein, les plus proches seront en premier        
            $columns = array_column($mapping_tempo_Rombn_label, 'Levenshtein');
            array_multisort($columns, SORT_ASC, $mapping_tempo_Rombn_label);            

//            Recherche dans em_denom_map
            $k2=0;

            foreach($denom_maps  as $denom_map) {
                 $BNLabel_denom_map =$denom_map->getBNLabel();               
                if (!empty($BNLabel_denom_map)) {
//               est ce qu'on retrouve le BNLabel denom_map dans le todo.denomination
                    if (strpos($denom_to_find, $BNLabel_denom_map) !== FALSE) {
    //                    on retrouve le BN_Label denom_map dans le todo.denomination
                        $k2++;
                        $id_denom_map =$denom_map->getId();
                        $Label_denom_map =$denom_map->getLabel();
                        $CIS_denom_map =$denom_map->getCIS();
                        $ATC7_denom_map =$denom_map->getATC7();
                        $levBNl = levenshtein($denom_to_find, $BNLabel_denom_map);
                        $levLab = levenshtein($denom_to_find, $Label_denom_map);

                        $mapping_tempo_Maplabel[$k2]['Denomination'] = $denom_to_find;
                        $mapping_tempo_Maplabel[$k2]['LstNumBNPV']=$denom_lst_numBNPV;
                        $mapping_tempo_Maplabel[$k2]['BNLabel']=$BNLabel_denom_map;
                        $mapping_tempo_Maplabel[$k2]['Levenshtein']=$levLab;
                        $mapping_tempo_Maplabel[$k2]['id_denom_map_todo']=$id_denom_map_todo;
                        $mapping_tempo_Maplabel[$k2]['id_denom_map']=$id_denom_map;
                        $mapping_tempo_Maplabel[$k2]['id_Romedi']=null;
                        $mapping_tempo_Maplabel[$k2]['Label']=$Label_denom_map;
                        $mapping_tempo_Maplabel[$k2]['CIS']=$CIS_denom_map;
                        $mapping_tempo_Maplabel[$k2]['ATC7']=$ATC7_denom_map;
                        $mapping_tempo_Maplabel[$k2]['TypeTxtMining']='2_Map_Lab';

                        $mapping_tempo_Mapbn_label[$k2]['Denomination']=$denom_to_find;
                        $mapping_tempo_Mapbn_label[$k2]['LstNumBNPV']=$denom_lst_numBNPV;
                        $mapping_tempo_Mapbn_label[$k2]['BNLabel']=$BNLabel_denom_map;
                        $mapping_tempo_Mapbn_label[$k2]['Levenshtein']=$levBNl;
                        $mapping_tempo_Mapbn_label[$k2]['id_denom_map_todo']=$id_denom_map_todo;
                        $mapping_tempo_Mapbn_label[$k2]['id_denom_map']=$id_denom_map;
                        $mapping_tempo_Mapbn_label[$k2]['id_Romedi']=null;
                        $mapping_tempo_Mapbn_label[$k2]['Label']=$Label_denom_map;
                        $mapping_tempo_Mapbn_label[$k2]['CIS']=$CIS_denom_map;
                        $mapping_tempo_Mapbn_label[$k2]['ATC7']=$ATC7_denom_map;
                        $mapping_tempo_Mapbn_label[$k2]['TypeTxtMining']='4_Map_BNl';
                    }
                }
            }
            
            // tri ascendant du tableau selon la distance de Levenshtein, les plus proches seront en premier        
            $columns = array_column($mapping_tempo_Maplabel, 'Levenshtein');
            array_multisort($columns, SORT_ASC, $mapping_tempo_Maplabel);   
            
            // tri ascendant du tableau selon la distance de Levenshtein, les plus proches seront en premier        
            $columns = array_column($mapping_tempo_Mapbn_label, 'Levenshtein');
            array_multisort($columns, SORT_ASC, $mapping_tempo_Mapbn_label);            
            
            // Construction du tableau avec les différents text mining
            // On ne prend que les n premieres lignes (les plus proches en recherche flou)

            // Type de recherche : 1_Rom_Lab
            if(count($mapping_tempo_Romlabel)!== 0 or count($mapping_tempo_Maplabel)!== 0 or count($mapping_tempo_Rombn_label)!== 0 or count($mapping_tempo_Mapbn_label)!== 0) {
                if(count($mapping_tempo_Romlabel)!== 0) {
                    if (count($mapping_tempo_Romlabel)<$this->nb_propositions){
                        $ctp = count($mapping_tempo_Romlabel);
                    } else {
                        $ctp = $this->nb_propositions;
                    }
                    for ($i=0;$i<$ctp;$i++){

//                        $mapping[$k1]['Denomination'] = $denom_to_find;
                        $mapping[$k1][1][$i] = $mapping_tempo_Romlabel[$i];
//                        $mapping[$k1][1]['TypeTxtMining'] = '1_Rom_Lab';
                    }
                }            

            // Type de recherche : 2_Map_Lab
                if(count($mapping_tempo_Maplabel)!== 0) {
                    if (count($mapping_tempo_Maplabel)<$this->nb_propositions){
                        $ctp = count($mapping_tempo_Maplabel);
                    } else {
                        $ctp = $this->nb_propositions;
                    }
                    $j=0;
                    for ($i=0;$i<$ctp;$i++){
                        if (!$this->DejaDansTabMapping($mapping, 
                                $mapping_tempo_Maplabel[$i]['id_denom_map_todo'], 
                                $mapping_tempo_Maplabel[$i]['id_Romedi'], 
                                $mapping_tempo_Maplabel[$i]['id_denom_map'])){
                            $mapping[$k1][2][$j] = $mapping_tempo_Maplabel[$i];
                            $j++;
//                        $mapping[$k1][2]['TypeTxtMining'] = '2_Map_Lab';
                        }

                    }
                }

            // Type de recherche : 3_Rom_BNl
                if(count($mapping_tempo_Rombn_label)!== 0) {
                    if (count($mapping_tempo_Rombn_label)<$this->nb_propositions){
                        $ctp = count($mapping_tempo_Rombn_label);
                    } else {
                        $ctp = $this->nb_propositions;
                    }
                    $j=0;
                    for ($i=0;$i<$ctp;$i++){

                        if (!$this->DejaDansTabMapping($mapping, 
                                $mapping_tempo_Rombn_label[$i]['id_denom_map_todo'], 
                                $mapping_tempo_Rombn_label[$i]['id_Romedi'], 
                                $mapping_tempo_Rombn_label[$i]['id_denom_map'])){

                            $mapping[$k1][3][$j] = $mapping_tempo_Rombn_label[$i];
                            $j++;
//                        $mapping[$k1][3]['TypeTxtMining'] = '3_Rom_BNl';
                        }
                    }
                }

            // Type de recherche : 4_Map_BNl
                if(count($mapping_tempo_Mapbn_label)!== 0) {
                    if (count($mapping_tempo_Mapbn_label)<$this->nb_propositions){
                        $ctp = count($mapping_tempo_Mapbn_label);
                    } else {
                        $ctp = $this->nb_propositions;
                    }
                    $j=0;
                    for ($i=0;$i<$ctp;$i++){
                        if (!$this->DejaDansTabMapping($mapping, 
                                $mapping_tempo_Mapbn_label[$i]['id_denom_map_todo'], 
                                $mapping_tempo_Mapbn_label[$i]['id_Romedi'], 
                                $mapping_tempo_Mapbn_label[$i]['id_denom_map'])){

                            $mapping[$k1][4][$j] = $mapping_tempo_Mapbn_label[$i];
//                        $mapping[$k1][4]['TypeTxtMining'] = '4_Map_BNl';
                            $j++;
                        }
                    }
                }
                $k1++;
            }
            
            if ($k1>$this->nb_lignes_traitees) {
                break;
            }
        }
//dd($mapping);




        return $this->render('trt_reliquat_txt_mining/txt_mining.html.twig', [
            'mapping' => $mapping,
        ]);
    }
    
     /**
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return Response
     */
    #[Route(path: '/trt_reliquat_txt_mining_pgn', name: 'trt_reliquat_txt_mining_pgn')]
    public function listeReliquat_txt_mining_levenshtein_paginate(Request $request, EntityManagerInterface $em, PaginatorInterface $paginator):Response
    {
        
        set_time_limit(360);
        
        $ObjAccess = new DatabaseAccess();

        $repo_todo = $em->getRepository(EmDenomMapTodoV2::class);
        $todos = $repo_todo->findAll();
                
        $repo_map = $em->getRepository(EmDenomMapV2::class);
        $denom_maps = $repo_map->findAll();

        $repo_romedi = $em->getRepository(EmRomediV2::class);
        $romedis = $repo_romedi->findAll();
        $k1 = 0;
        
        $mapping = array();
        
        foreach ($todos as $todo) {
            $mapping_tempo_Romlabel = array();
            $mapping_tempo_Rombn_label = array();
            $mapping_tempo_Maplabel = array();
            $mapping_tempo_Mapbn_label = array();
            
            $denom_to_find = $todo->getdenomination();

            
            if (is_null($todo->getLstNumBNPV())) {
                // $ObjAccess = new DatabaseAccess();
                // $lst_numBNPV =  $ObjAccess->DonneListe_numBNPV($todo->getdenomination());
                $denom_lst_numBNPV =  $ObjAccess->DonneListe_numBNPV($denom_to_find);
                $todo->setLstNumBNPV($denom_lst_numBNPV);
                $em->persist($todo);
                $em->flush();
            } else {
                $denom_lst_numBNPV=$todo->getLstNumBNPV();
            }
            

            $id_denom_map_todo = $todo->getId();
//            Recherche dans ROMEDI
            $k2=0;

            foreach($romedis  as $romedi) {
                 $BNLabel_Romedi =$romedi->getBNLabelRomedi();               
                
//               est ce qu'on retrouve le BN_Label Romedi dans le todo.denomination
                if (strpos($denom_to_find, $BNLabel_Romedi) !== FALSE) {
//                    on retrouve le BN_Label Romedi dans le todo.denomination
                    $k2++;
                    $id_Romedi =$romedi->getId();
                    $Label_Romedi =$romedi->getLabel();
                    $CIS_Romedi =$romedi->getCIS();
                    $ATC7_Romedi =$romedi->getATC7();
                    $levBNl = levenshtein($denom_to_find, $BNLabel_Romedi);
                    $levLab = levenshtein($denom_to_find, $Label_Romedi);

                    $mapping_tempo_Romlabel[$k2]['Denomination']=$denom_to_find;
                    $mapping_tempo_Romlabel[$k2]['LstNumBNPV']=$denom_lst_numBNPV;
                    $mapping_tempo_Romlabel[$k2]['BNLabel']=$BNLabel_Romedi;
                    $mapping_tempo_Romlabel[$k2]['Levenshtein']=$levLab;
                    $mapping_tempo_Romlabel[$k2]['id_denom_map_todo']=$id_denom_map_todo;
                    $mapping_tempo_Romlabel[$k2]['id_denom_map']=null;
                    $mapping_tempo_Romlabel[$k2]['id_Romedi']=$id_Romedi;
                    $mapping_tempo_Romlabel[$k2]['Label']=$Label_Romedi;
                    $mapping_tempo_Romlabel[$k2]['CIS']=$CIS_Romedi;
                    $mapping_tempo_Romlabel[$k2]['ATC7']=$ATC7_Romedi;
                    $mapping_tempo_Romlabel[$k2]['TypeTxtMining']='1_Rom_Lab';
                    
                    $mapping_tempo_Rombn_label[$k2]['Denomination']=$denom_to_find;
                    $mapping_tempo_Rombn_label[$k2]['LstNumBNPV']=$denom_lst_numBNPV;
                    $mapping_tempo_Rombn_label[$k2]['BNLabel']=$BNLabel_Romedi;
                    $mapping_tempo_Rombn_label[$k2]['Levenshtein']=$levBNl;
                    $mapping_tempo_Rombn_label[$k2]['id_denom_map_todo']=$id_denom_map_todo;
                    $mapping_tempo_Rombn_label[$k2]['id_denom_map']=null;
                    $mapping_tempo_Rombn_label[$k2]['id_Romedi']=$id_Romedi;
                    $mapping_tempo_Rombn_label[$k2]['Label']=$Label_Romedi;
                    $mapping_tempo_Rombn_label[$k2]['CIS']=$CIS_Romedi;
                    $mapping_tempo_Rombn_label[$k2]['ATC7']=$ATC7_Romedi;
                    $mapping_tempo_Rombn_label[$k2]['TypeTxtMining']='3_Rom_BNl';
                }
            }
            
            // tri ascendant du tableau selon la distance de Levenshtein, les plus proches seront en premier        
            $columns = array_column($mapping_tempo_Romlabel, 'Levenshtein');
            array_multisort($columns, SORT_ASC, $mapping_tempo_Romlabel);   
            
            // tri ascendant du tableau selon la distance de Levenshtein, les plus proches seront en premier        
            $columns = array_column($mapping_tempo_Rombn_label, 'Levenshtein');
            array_multisort($columns, SORT_ASC, $mapping_tempo_Rombn_label);            

//            Recherche dans em_denom_map
            $k2=0;

            foreach($denom_maps  as $denom_map) {
                 $BNLabel_denom_map =$denom_map->getBNLabel();               
                if (!empty($BNLabel_denom_map)) {
//               est ce qu'on retrouve le BNLabel denom_map dans le todo.denomination
                    if (strpos($denom_to_find, $BNLabel_denom_map) !== FALSE) {
    //                    on retrouve le BN_Label denom_map dans le todo.denomination
                        $k2++;
                        $id_denom_map =$denom_map->getId();
                        $Label_denom_map =$denom_map->getLabel();
                        $CIS_denom_map =$denom_map->getCIS();
                        $ATC7_denom_map =$denom_map->getATC7();
                        $levBNl = levenshtein($denom_to_find, $BNLabel_denom_map);
                        $levLab = levenshtein($denom_to_find, $Label_denom_map);

                        $mapping_tempo_Maplabel[$k2]['Denomination'] = $denom_to_find;
                        $mapping_tempo_Maplabel[$k2]['LstNumBNPV']=$denom_lst_numBNPV;
                        $mapping_tempo_Maplabel[$k2]['BNLabel']=$BNLabel_denom_map;
                        $mapping_tempo_Maplabel[$k2]['Levenshtein']=$levLab;
                        $mapping_tempo_Maplabel[$k2]['id_denom_map_todo']=$id_denom_map_todo;
                        $mapping_tempo_Maplabel[$k2]['id_denom_map']=$id_denom_map;
                        $mapping_tempo_Maplabel[$k2]['id_Romedi']=null;
                        $mapping_tempo_Maplabel[$k2]['Label']=$Label_denom_map;
                        $mapping_tempo_Maplabel[$k2]['CIS']=$CIS_denom_map;
                        $mapping_tempo_Maplabel[$k2]['ATC7']=$ATC7_denom_map;
                        $mapping_tempo_Maplabel[$k2]['TypeTxtMining']='2_Map_Lab';

                        $mapping_tempo_Mapbn_label[$k2]['Denomination']=$denom_to_find;
                        $mapping_tempo_Mapbn_label[$k2]['LstNumBNPV']=$denom_lst_numBNPV;
                        $mapping_tempo_Mapbn_label[$k2]['BNLabel']=$BNLabel_denom_map;
                        $mapping_tempo_Mapbn_label[$k2]['Levenshtein']=$levBNl;
                        $mapping_tempo_Mapbn_label[$k2]['id_denom_map_todo']=$id_denom_map_todo;
                        $mapping_tempo_Mapbn_label[$k2]['id_denom_map']=$id_denom_map;
                        $mapping_tempo_Mapbn_label[$k2]['id_Romedi']=null;
                        $mapping_tempo_Mapbn_label[$k2]['Label']=$Label_denom_map;
                        $mapping_tempo_Mapbn_label[$k2]['CIS']=$CIS_denom_map;
                        $mapping_tempo_Mapbn_label[$k2]['ATC7']=$ATC7_denom_map;
                        $mapping_tempo_Mapbn_label[$k2]['TypeTxtMining']='4_Map_BNl';
                    }
                }
            }
            
            // tri ascendant du tableau selon la distance de Levenshtein, les plus proches seront en premier        
            $columns = array_column($mapping_tempo_Maplabel, 'Levenshtein');
            array_multisort($columns, SORT_ASC, $mapping_tempo_Maplabel);   
            
            // tri ascendant du tableau selon la distance de Levenshtein, les plus proches seront en premier        
            $columns = array_column($mapping_tempo_Mapbn_label, 'Levenshtein');
            array_multisort($columns, SORT_ASC, $mapping_tempo_Mapbn_label);            
            
            // Construction du tableau avec les différents text mining
            // On ne prend que les n premieres lignes (les plus proches en recherche flou)

            // Type de recherche : 1_Rom_Lab
            if(count($mapping_tempo_Romlabel)!== 0 or count($mapping_tempo_Maplabel)!== 0 or count($mapping_tempo_Rombn_label)!== 0 or count($mapping_tempo_Mapbn_label)!== 0) {
                if(count($mapping_tempo_Romlabel)!== 0) {
                    if (count($mapping_tempo_Romlabel)<$this->nb_propositions){
                        $ctp = count($mapping_tempo_Romlabel);
                    } else {
                        $ctp = $this->nb_propositions;
                    }
                    for ($i=0;$i<$ctp;$i++){

//                        $mapping[$k1]['Denomination'] = $denom_to_find;
                        $mapping[$k1][1][$i] = $mapping_tempo_Romlabel[$i];
//                        $mapping[$k1][1]['TypeTxtMining'] = '1_Rom_Lab';
                    }
                }            

            // Type de recherche : 2_Map_Lab
                if(count($mapping_tempo_Maplabel)!== 0) {
                    if (count($mapping_tempo_Maplabel)<$this->nb_propositions){
                        $ctp = count($mapping_tempo_Maplabel);
                    } else {
                        $ctp = $this->nb_propositions;
                    }
                    $j=0;
                    for ($i=0;$i<$ctp;$i++){
                        if (!$this->DejaDansTabMapping($mapping, 
                                $mapping_tempo_Maplabel[$i]['id_denom_map_todo'], 
                                $mapping_tempo_Maplabel[$i]['id_Romedi'], 
                                $mapping_tempo_Maplabel[$i]['id_denom_map'])){
                            $mapping[$k1][2][$j] = $mapping_tempo_Maplabel[$i];
                            $j++;
//                        $mapping[$k1][2]['TypeTxtMining'] = '2_Map_Lab';
                        }

                    }
                }

            // Type de recherche : 3_Rom_BNl
                if(count($mapping_tempo_Rombn_label)!== 0) {
                    if (count($mapping_tempo_Rombn_label)<$this->nb_propositions){
                        $ctp = count($mapping_tempo_Rombn_label);
                    } else {
                        $ctp = $this->nb_propositions;
                    }
                    $j=0;
                    for ($i=0;$i<$ctp;$i++){

                        if (!$this->DejaDansTabMapping($mapping, 
                                $mapping_tempo_Rombn_label[$i]['id_denom_map_todo'], 
                                $mapping_tempo_Rombn_label[$i]['id_Romedi'], 
                                $mapping_tempo_Rombn_label[$i]['id_denom_map'])){

                            $mapping[$k1][3][$j] = $mapping_tempo_Rombn_label[$i];
                            $j++;
//                        $mapping[$k1][3]['TypeTxtMining'] = '3_Rom_BNl';
                        }
                    }
                }

            // Type de recherche : 4_Map_BNl
                if(count($mapping_tempo_Mapbn_label)!== 0) {
                    if (count($mapping_tempo_Mapbn_label)<$this->nb_propositions){
                        $ctp = count($mapping_tempo_Mapbn_label);
                    } else {
                        $ctp = $this->nb_propositions;
                    }
                    $j=0;
                    for ($i=0;$i<$ctp;$i++){
                        if (!$this->DejaDansTabMapping($mapping, 
                                $mapping_tempo_Mapbn_label[$i]['id_denom_map_todo'], 
                                $mapping_tempo_Mapbn_label[$i]['id_Romedi'], 
                                $mapping_tempo_Mapbn_label[$i]['id_denom_map'])){

                            $mapping[$k1][4][$j] = $mapping_tempo_Mapbn_label[$i];
//                        $mapping[$k1][4]['TypeTxtMining'] = '4_Map_BNl';
                            $j++;
                        }
                    }
                }
                $k1++;
            }
            
            // if ($k1>$this->nb_lignes_traitees) {
            //     break;
            // }
        }
//dd($mapping);


        $pgnMapping = $paginator->paginate(
            $mapping, 
            $request->query->getInt('page', 1),
            100
        );



        return $this->render('trt_reliquat_txt_mining/txt_mining_pgn.html.twig', [
            // 'mapping' => $mapping,
            'mapping' => $pgnMapping,
        ]);
    }
    
    /**
     * 
     * @param array $mapping
     * @param Integer $id_denom_map_todo
     * @param Integer $id_Romedi
     * @param Integer $id_denom_map
     * @return Boolean
     */
    private function DejaDansTabMapping(Array $mapping, Int $id_denom_map_todo, ?Int $id_Romedi, ?Int $id_denom_map):Bool {
        foreach($mapping as $mappin) {
             foreach($mappin as $mappi) {
                foreach($mappi as $mapp) {
                   if($id_Romedi === null ) {
                        if ($mapp['id_denom_map_todo'] === $id_denom_map_todo AND $mapp['id_denom_map'] === $id_denom_map){
                            return true;
                        }
                    }
                    if($id_denom_map === null ) {
                        if ($mapp['id_denom_map_todo'] === $id_denom_map_todo AND $mapp['id_Romedi'] === $id_Romedi){
                            return true;
                        }
                    }
                }                        
            }
        }

        return false;
    }
}
