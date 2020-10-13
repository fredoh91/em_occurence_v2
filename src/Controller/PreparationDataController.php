<?php

namespace App\Controller;

use App\MsAccess\Traitements\TrtBaseEM;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

class PreparationDataController extends AbstractController
{
    /**
     * @Route("/preparation_data", name="preparation_data")
     */
    public function PreparationData(EntityManagerInterface $em):Response
    {
        
        
        // import des données Access : $TrtAccess->importBaseEM();
        $TrtAccess=new TrtBaseEM($em);
//        $TrtAccess->DBaccess();
//        $TrtAccess->ExtractionAccessOccEM(); 
        $TrtAccess->importBaseEM();
        // 
        // sauvegardes des tables MySQL : $TrtMySQL->sauvegardeTables();
        // 
        // Mise à jour des tables MySQL : $TrtMySQL->MajTables();
        
        
        
        return $this->render('preparation_data/preparation_data.html.twig', [
            'controller_name' => 'PreparationDataController',
        ]);
    }
}
