<?php

namespace App\Controller;

use App\Entity\EmDenomMapTodoV2;
use App\Entity\EmDenomMapV2;
use App\Entity\EmRomediV2;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TrtReliquatTxtMiningController extends AbstractController
{
    private $nb_propositions = 5;
    /**
     * @Route("/trt/reliquat/txt/mining", name="trt_reliquat_txt_mining")
     */
    public function index(): Response
    {
        return $this->render('trt_reliquat_txt_mining/index.html.twig', [
            'controller_name' => 'TrtReliquatTxtMiningController',
        ]);
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
                
        $repo = $em->getRepository(EmDenomMapTodoV2::class);

        $todos = $repo->findAll();

        $repo_romedi = $em->getRepository(EmRomediV2::class);
        $romedis = $repo_romedi->findAll();

        $mapping = array();
        foreach ($todos as $k1 => $todo) {
            $mapping_tempo = array();
            $denom_to_find = $todo->getdenomination();
            $id_denom_map_todo = $todo->getId();
            
            foreach($romedis  as $k2 => $romedi) {
                
                $BNLabel_Romedi =$romedi->getBNLabelRomedi();
                $id_Romedi =$romedi->getId();
                $Label_Romedi =$romedi->getLabel();
                $CIS_Romedi =$romedi->getCIS();
                $ATC7_Romedi =$romedi->getATC7();
                $lev = levenshtein($denom_to_find, $BNLabel_Romedi);

                $mapping_tempo[$k2]['Denomination']=$denom_to_find;
                $mapping_tempo[$k2]['BNLabel']=$BNLabel_Romedi;
                $mapping_tempo[$k2]['Levenshtein']=$lev;
                $mapping_tempo[$k2]['id_denom_map_todo']=$id_denom_map_todo;
                $mapping_tempo[$k2]['id_Romedi']=$id_Romedi;
                $mapping_tempo[$k2]['Label_Romedi']=$Label_Romedi;
                $mapping_tempo[$k2]['CIS_Romedi']=$CIS_Romedi;
                $mapping_tempo[$k2]['ATC7_Romedi']=$ATC7_Romedi;
                
            }
            
            // tri ascendant du tableau selon la distance de Levenshtein, les plus proches seront en premier        
            $columns = array_column($mapping_tempo, 'Levenshtein');
            array_multisort($columns, SORT_ASC, $mapping_tempo);            
            
            // On ne prend que les n premieres lignes (les plus proches en recherche flou)
            
            for ($i=0;$i<$this->nb_propositions;$i++){
                $mapping[$k1][$i] = $mapping_tempo[$i];
            }
           
//            dump($k1);
            
            if ($k1>10) {
                break;
            }
            
        }

        return $this->render('trt_reliquat_txt_mining/txt_mining.html.twig', [
            'mapping' => $mapping
        ]);
    }
    
     /**
     * @Route("/trt_reliquat_txt_mining_similar_text", name="trt_reliquat_txt_mining_similar_text")
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return Response
     */
    public function listeReliquat_txt_mining_similar_text(Request $request, EntityManagerInterface $em):Response
    {
        
        set_time_limit(360);
                
        $repo = $em->getRepository(EmDenomMapTodoV2::class);

        $todos = $repo->findAll();

        $repo_romedi = $em->getRepository(EmRomediV2::class);
        $romedis = $repo_romedi->findAll();

        $mapping = array();
        foreach ($todos as $k1 => $todo) {
            $mapping_tempo = array();
            $denom_to_find = $todo->getdenomination();
            $id_denom_map_todo = $todo->getId();
            
            foreach($romedis  as $k2 => $romedi) {
                
                $BNLabel_Romedi =$romedi->getBNLabelRomedi();
                $id_Romedi =$romedi->getId();
                $Label_Romedi =$romedi->getLabel();
                $CIS_Romedi =$romedi->getCIS();
                $ATC7_Romedi =$romedi->getATC7();
                $lev = similar_text($denom_to_find, $BNLabel_Romedi);

                $mapping_tempo[$k2]['Denomination']=$denom_to_find;
                $mapping_tempo[$k2]['BNLabel']=$BNLabel_Romedi;
                $mapping_tempo[$k2]['Levenshtein']=$lev;
                $mapping_tempo[$k2]['id_denom_map_todo']=$id_denom_map_todo;
                $mapping_tempo[$k2]['id_Romedi']=$id_Romedi;
                $mapping_tempo[$k2]['Label_Romedi']=$Label_Romedi;
                $mapping_tempo[$k2]['CIS_Romedi']=$CIS_Romedi;
                $mapping_tempo[$k2]['ATC7_Romedi']=$ATC7_Romedi;
                
            }
            
            // tri ascendant du tableau selon la distance de Levenshtein, les plus proches seront en premier        
            $columns = array_column($mapping_tempo, 'Levenshtein');
            array_multisort($columns, SORT_DESC, $mapping_tempo);            
            
            // On ne prend que les n premieres lignes (les plus proches en recherche flou)
            
            for ($i=0;$i<$this->nb_propositions;$i++){
                $mapping[$k1][$i] = $mapping_tempo[$i];
            }
           
//            dump($k1);
            
            if ($k1>10) {
                break;
            }
            
        }

        return $this->render('trt_reliquat_txt_mining/txt_mining.html.twig', [
            'mapping' => $mapping
        ]);
    }

}
