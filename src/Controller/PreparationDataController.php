<?php

namespace App\Controller;

use App\MsAccess\Traitements\TrtBaseEM;
use App\MySQL\Traitements\TrtMySQL;
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
//        $TrtAccess=new TrtBaseEM($em);
//        $TrtAccess->importBaseEM();

        // sauvegardes des tables MySQL : $TrtMySQL->sauvegardeTables();
        $TrtMySQL=new TrtMySQL($em);
//        $TrtMySQL->SauveEtResetTable("em_occ_produit_v2");
//        $TrtMySQL->SauveEtResetTable("em_occ_deno_v2");
////        $TrtMySQL->SauveTable("em_grille_occ_v2");
//        $TrtMySQL->SauveTable("grille_occ_em_v2");
//        // Mise à jour des tables MySQL : $TrtMySQL->MajTables();
        $TrtMySQL->rempliEmOccProduitV2();

        // Message flash pour avertir l'utilisateur
        $this->addFlash('success', 'Traitement terminé.');
            
        
        return $this->render('preparation_data/preparation_data.html.twig', [
            'controller_name' => 'PreparationDataController',
        ]);
    }
}
