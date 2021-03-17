<?php

namespace App\Controller;

use App\Entity\EmDenomMapTodoV2;
use App\Entity\EmDenomMapV2;
use App\Entity\EmRomediV2;
use App\Form\ModifTodoListeType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class TrtReliquatTxtMiningController extends AbstractController
{
    private $nb_propositions = 5;
    private $nb_lignes_traitees = 5;

    
    
     /**
     * @Route("/trt_reliquat_txt_mining_label", name="trt_reliquat_txt_mining_label")
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return Response
     */
//    public function listeReliquat_txt_mining_levenshtein_label(Request $request, EntityManagerInterface $em):Response
//    {
//        
//        set_time_limit(360);
//                
//        $repo = $em->getRepository(EmDenomMapTodoV2::class);
//
//        $todos = $repo->findAll();
//
//        $repo_romedi = $em->getRepository(EmRomediV2::class);
//        $romedis = $repo_romedi->findAll();
//
//        $mapping = array();
//        foreach ($todos as $k1 => $todo) {
//            $mapping_tempo = array();
//            $denom_to_find = $todo->getdenomination();
//            $id_denom_map_todo = $todo->getId();
//            
//            foreach($romedis  as $k2 => $romedi) {
//                
//                $BNLabel_Romedi =$romedi->getBNLabelRomedi();
//                $id_Romedi =$romedi->getId();
//                $Label_Romedi =$romedi->getLabel();
//                $CIS_Romedi =$romedi->getCIS();
//                $ATC7_Romedi =$romedi->getATC7();
//                $lev = levenshtein($denom_to_find, substr($Label_Romedi, 0, 255));
//
//                $mapping_tempo[$k2]['Denomination']=$denom_to_find;
//                $mapping_tempo[$k2]['BNLabel']=$BNLabel_Romedi;
//                $mapping_tempo[$k2]['Levenshtein']=$lev;
//                $mapping_tempo[$k2]['id_denom_map_todo']=$id_denom_map_todo;
//                $mapping_tempo[$k2]['id_Romedi']=$id_Romedi;
//                $mapping_tempo[$k2]['Label_Romedi']=$Label_Romedi;
//                $mapping_tempo[$k2]['CIS_Romedi']=$CIS_Romedi;
//                $mapping_tempo[$k2]['ATC7_Romedi']=$ATC7_Romedi;
//                
//            }
//            
//            // tri ascendant du tableau selon la distance de Levenshtein, les plus proches seront en premier        
//            $columns = array_column($mapping_tempo, 'Levenshtein');
//            array_multisort($columns, SORT_ASC, $mapping_tempo);            
//            
//            // On ne prend que les n premieres lignes (les plus proches en recherche flou)
//            
//            for ($i=0;$i<$this->nb_propositions;$i++){
//                $mapping[$k1][$i] = $mapping_tempo[$i];
//            }
//           
////            dump($k1);
//            
//            if ($k1>$this->nb_lignes_traitees) {
//                break;
//            }
//            
//        }
//
//        return $this->render('trt_reliquat_txt_mining/txt_mining.html.twig', [
//            'mapping' => $mapping
//        ]);
//    }
//        
//    
     /**
     * @Route("/trt_reliquat_txt_mining_test", name="trt_reliquat_txt_mining_test")
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return Response
     */
    public function listeReliquat_txt_mining_test(Request $request, EntityManagerInterface $em):Response
    {
        
        set_time_limit(360);
                
        $repo = $em->getRepository(EmDenomMapTodoV2::class);

//        $todos = $repo->findAll();
        $todos = $repo->findLimitTo(5);
        
        
//        $repo = $em->getRepository(EmDenomMapTodoV2::class);
        $reliquat = $repo->find(1);
        $form = $this->createForm(ModifTodoListeType::class,$reliquat);
        
//        if (isset($_POST['Denomination_1'])){
//        if (!empty($_POST['Denomination_1'])){
//            dd($_POST['Denomination_1']);
//            
//        }
        
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            dd($form);
        }
        
        
//                $form = $this->createFormBuilder($task)
//            ->add('task', TextType::class)
//            ->add('dueDate', DateType::class)
//            ->add('save', SubmitType::class, ['label' => 'Create Task'])
//            ->getForm();
        
//        foreach($todos as $k => $v){
//
//            $form_tab[]=$this->createForm(ModifTodoListeType::class,$v)->createView();
//
//        }

//        return $this->render('trt_reliquat_txt_mining/rech_romedi_test_createForm.html.twig', [
//            'form' => $form->createView(),
//            'form_tab' => $form_tab
//        ]);

        return $this->render('trt_reliquat_txt_mining/rech_romedi_test.html.twig', [
            'todos' => $todos
        ]);
    }
    
     /**
     * @Route("/trt_todo_list_reliquat_txt_mining", name="trt_todo_list_reliquat_txt_mining")
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return Response
     */
    public function trt_todo_list_reliquat_txt_mining(Request $request, EntityManagerInterface $em):Response
    {
        
    }
    
     /**
     * @Route("/trt_reliquat_txt_mining", name="trt_reliquat_txt_mining")
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return Response
     */
    public function listeReliquat_txt_mining_levenshtein(Request $request, EntityManagerInterface $em):Response
    {
        
        set_time_limit(360);
                
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
            $id_denom_map_todo = $todo->getId();
//            Recherche dans ROMEDI
            $k2=0;
//            foreach($romedis  as $k2 => $romedi) {
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
                        $mapping_tempo_Maplabel[$k2]['BNLabel']=$BNLabel_denom_map;
                        $mapping_tempo_Maplabel[$k2]['Levenshtein']=$levLab;
                        $mapping_tempo_Maplabel[$k2]['id_denom_map_todo']=$id_denom_map_todo;
                        $mapping_tempo_Maplabel[$k2]['id_denom_map']=$id_denom_map;
                        $mapping_tempo_Maplabel[$k2]['id_Romedi']=null;
                        $mapping_tempo_Maplabel[$k2]['Label']=$Label_denom_map;
                        $mapping_tempo_Maplabel[$k2]['CIS']=$CIS_Romedi;
                        $mapping_tempo_Maplabel[$k2]['ATC7']=$ATC7_Romedi;
                        $mapping_tempo_Maplabel[$k2]['TypeTxtMining']='2_Map_Lab';

                        $mapping_tempo_Mapbn_label[$k2]['Denomination']=$denom_to_find;
                        $mapping_tempo_Mapbn_label[$k2]['BNLabel']=$BNLabel_denom_map;
                        $mapping_tempo_Mapbn_label[$k2]['Levenshtein']=$levBNl;
                        $mapping_tempo_Mapbn_label[$k2]['id_denom_map_todo']=$id_denom_map_todo;
                        $mapping_tempo_Mapbn_label[$k2]['id_denom_map']=$id_denom_map;
                        $mapping_tempo_Mapbn_label[$k2]['id_Romedi']=null;
                        $mapping_tempo_Mapbn_label[$k2]['Label']=$Label_denom_map;
                        $mapping_tempo_Mapbn_label[$k2]['CIS']=$CIS_Romedi;
                        $mapping_tempo_Mapbn_label[$k2]['ATC7']=$ATC7_Romedi;
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

                if(count($mapping_tempo_Maplabel)!== 0) {
                    if (count($mapping_tempo_Maplabel)<$this->nb_propositions){
                        $ctp = count($mapping_tempo_Maplabel);
                    } else {
                        $ctp = $this->nb_propositions;
                    }
                    for ($i=0;$i<$ctp;$i++){

                        $mapping[$k1][2][$i] = $mapping_tempo_Maplabel[$i];
//                        $mapping[$k1][2]['TypeTxtMining'] = '2_Map_Lab';
                    }
                }

                if(count($mapping_tempo_Rombn_label)!== 0) {
                    if (count($mapping_tempo_Rombn_label)<$this->nb_propositions){
                        $ctp = count($mapping_tempo_Rombn_label);
                    } else {
                        $ctp = $this->nb_propositions;
                    }
                    for ($i=0;$i<$ctp;$i++){

                        $mapping[$k1][3][$i] = $mapping_tempo_Rombn_label[$i];
//                        $mapping[$k1][3]['TypeTxtMining'] = '3_Rom_BNl';
                    }
                }            

                if(count($mapping_tempo_Mapbn_label)!== 0) {
                    if (count($mapping_tempo_Mapbn_label)<$this->nb_propositions){
                        $ctp = count($mapping_tempo_Mapbn_label);
                    } else {
                        $ctp = $this->nb_propositions;
                    }
                    for ($i=0;$i<$ctp;$i++){

                        $mapping[$k1][4][$i] = $mapping_tempo_Mapbn_label[$i];
//                        $mapping[$k1][4]['TypeTxtMining'] = '4_Map_BNl';
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
            'mapping' => $mapping
        ]);
    }    
     /**
     * @Route("/trt_reliquat_txt_mining_v1", name="trt_reliquat_txt_mining_v1")
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return Response
     */
//    public function listeReliquat_txt_mining_levenshtein_v1(Request $request, EntityManagerInterface $em):Response
//    {
//        
//        set_time_limit(360);
//                
//        $repo = $em->getRepository(EmDenomMapTodoV2::class);
//
//        $todos = $repo->findAll();
//
//        $repo_romedi = $em->getRepository(EmRomediV2::class);
//        $romedis = $repo_romedi->findAll();
//
//        $mapping = array();
//        foreach ($todos as $k1 => $todo) {
//            $mapping_tempo = array();
//            $denom_to_find = $todo->getdenomination();
//            $id_denom_map_todo = $todo->getId();
//            
//            foreach($romedis  as $k2 => $romedi) {
//                
//                $BNLabel_Romedi =$romedi->getBNLabelRomedi();
//                $id_Romedi =$romedi->getId();
//                $Label_Romedi =$romedi->getLabel();
//                $CIS_Romedi =$romedi->getCIS();
//                $ATC7_Romedi =$romedi->getATC7();
//                $lev = levenshtein($denom_to_find, $BNLabel_Romedi);
//
//                $mapping_tempo[$k2]['Denomination']=$denom_to_find;
//                $mapping_tempo[$k2]['BNLabel']=$BNLabel_Romedi;
//                $mapping_tempo[$k2]['Levenshtein']=$lev;
//                $mapping_tempo[$k2]['id_denom_map_todo']=$id_denom_map_todo;
//                $mapping_tempo[$k2]['id_Romedi']=$id_Romedi;
//                $mapping_tempo[$k2]['Label_Romedi']=$Label_Romedi;
//                $mapping_tempo[$k2]['CIS_Romedi']=$CIS_Romedi;
//                $mapping_tempo[$k2]['ATC7_Romedi']=$ATC7_Romedi;
//                
//            }
//            
//            // tri ascendant du tableau selon la distance de Levenshtein, les plus proches seront en premier        
//            $columns = array_column($mapping_tempo, 'Levenshtein');
//            array_multisort($columns, SORT_ASC, $mapping_tempo);            
//            
//            // On ne prend que les n premieres lignes (les plus proches en recherche flou)
//            
//            for ($i=0;$i<$this->nb_propositions;$i++){
//                $mapping[$k1][$i] = $mapping_tempo[$i];
//            }
//           
////            dump($k1);
//            
//            if ($k1>$this->nb_lignes_traitees) {
//                break;
//            }
//            
//        }
//
//        return $this->render('trt_reliquat_txt_mining/txt_mining.html.twig', [
//            'mapping' => $mapping
//        ]);
//    }
    
     /**
     * @Route("/trt_reliquat_txt_mining_similar_text", name="trt_reliquat_txt_mining_similar_text")
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return Response
     */
//    public function listeReliquat_txt_mining_similar_text(Request $request, EntityManagerInterface $em):Response
//    {
//        
//        set_time_limit(360);
//                
//        $repo = $em->getRepository(EmDenomMapTodoV2::class);
//
//        $todos = $repo->findAll();
//
//        $repo_romedi = $em->getRepository(EmRomediV2::class);
//        $romedis = $repo_romedi->findAll();
//
//        $mapping = array();
//        foreach ($todos as $k1 => $todo) {
//            $mapping_tempo = array();
//            $denom_to_find = $todo->getdenomination();
//            $id_denom_map_todo = $todo->getId();
//            
//            foreach($romedis  as $k2 => $romedi) {
//                
//                $BNLabel_Romedi =$romedi->getBNLabelRomedi();
//                $id_Romedi =$romedi->getId();
//                $Label_Romedi =$romedi->getLabel();
//                $CIS_Romedi =$romedi->getCIS();
//                $ATC7_Romedi =$romedi->getATC7();
//                $lev = similar_text($denom_to_find, $BNLabel_Romedi);
//
//                $mapping_tempo[$k2]['Denomination']=$denom_to_find;
//                $mapping_tempo[$k2]['BNLabel']=$BNLabel_Romedi;
//                $mapping_tempo[$k2]['Levenshtein']=$lev;
//                $mapping_tempo[$k2]['id_denom_map_todo']=$id_denom_map_todo;
//                $mapping_tempo[$k2]['id_Romedi']=$id_Romedi;
//                $mapping_tempo[$k2]['Label_Romedi']=$Label_Romedi;
//                $mapping_tempo[$k2]['CIS_Romedi']=$CIS_Romedi;
//                $mapping_tempo[$k2]['ATC7_Romedi']=$ATC7_Romedi;
//                
//            }
//            
//            // tri ascendant du tableau selon la distance de Levenshtein, les plus proches seront en premier        
//            $columns = array_column($mapping_tempo, 'Levenshtein');
//            array_multisort($columns, SORT_DESC, $mapping_tempo);            
//            
//            // On ne prend que les n premieres lignes (les plus proches en recherche flou)
//            
//            for ($i=0;$i<$this->nb_propositions;$i++){
//                $mapping[$k1][$i] = $mapping_tempo[$i];
//            }
//           
////            dump($k1);
//            
//            if ($k1>$this->nb_lignes_traitees) {
//                break;
//            }
//            
//        }
//
//        return $this->render('trt_reliquat_txt_mining/txt_mining.html.twig', [
//            'mapping' => $mapping
//        ]);
//    }

    /**
     *  @Route("/trt_reliquat/rech_romedi/{id}/attrib_romedi_test/{idRomedi}", name="attrib_romedi_test", requirements={
     * "id"="\d+",
     * "idRomedi"="\d+"
     * })
     * @param int $id
     * @param int $idRomedi
     * @param EntityManagerInterface $em
     * @return type
     */
    public function attribRomedi_test(int $id, int $idRomedi, EntityManagerInterface $em) {
        // edition de l'entité EmDenomMapTodoV2 ayant pour id $id en y mettant les données de l'entité EmRomediV2 ayant pour id $idRomedi
dd($id);
//        $repoTodo = $em->getRepository(EmDenomMapTodoV2::class);
//        $todo = $repoTodo->find($id);
//        $repoRomedi = $em->getRepository(EmRomediV2::class);
//        $Romedi = $repoRomedi->find($idRomedi);
//        $todo->setBNLabel($Romedi->getBNLabelRomedi())
//             ->setLabel($Romedi->getLabel())
//             ->setATC7($Romedi->getATC7())
//             ->setCIS($Romedi->getCIS());
//        $em->persist($todo);
//        $em->flush();
//        
//        // redirection vers la route rech_romedi avec id $id 
//        return $this->redirectToRoute('modif_reliquat', ['id' => $id]);
    }
}
