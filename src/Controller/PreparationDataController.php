<?php

namespace App\Controller;

use App\Entity\EmDatePreparationDataV2;
use App\MsAccess\Traitements\TrtBaseEM;
use App\MySQL\Traitements\MaJemGrille;
use App\MySQL\Traitements\TrtMySQL;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PreparationDataController extends AbstractController
{
    private $msgMaJemGrille;
    #[Route(path: '/preparation_data', name: 'preparation_data')]
    public function PreparationData(EntityManagerInterface $em):Response
    {
        set_time_limit(180);
        
        // import des données Access : $TrtAccess->importBaseEM();
        $TrtAccess=new TrtBaseEM($em);
        $TrtMySQL=new TrtMySQL($em);

        $TrtAccess->importBaseEM();

        $TrtMySQL->SauveEtResetTable("em_produits_base_access_v2");
        $TrtAccess->rempliEMProduitsBaseAccessV2();

        // sauvegardes des tables MySQL : $TrtMySQL->sauvegardeTables();
        $TrtMySQL->SauveEtResetTable("em_occ_produit_v2");
        $TrtMySQL->SauveEtResetTable("em_occ_deno_v2");

        $TrtMySQL->SauveTable("grille_occ_em_v2");
//        // Mise à jour des tables MySQL : $TrtMySQL->MajTables();
        $TrtMySQL->rempliEmOccProduitV2();

        $TrtMySQL->rempliEmOccDenoV2();

        
//        Mise à jour de la grille 
        $MaJemGrille=new MaJemGrille($em);
        $msgMaJemGrille = $MaJemGrille->MaJ();
        
//        mise à jour de la table "todo"
        $TrtMySQL->effaceTable("em_denom_map_todo_v2");
        $TrtMySQL->rempliEmDenomMapTodoV2();
        
//        sauvegarde la date de préparation des données
        $DtPrepData=new EmDatePreparationDataV2;
        $DtPrepData->setDatePreparationData(new \DateTime('now'));
        $em->persist($DtPrepData);
        $em->flush();
        
        // Message flash pour avertir l'utilisateur de la fin du traitement
        $this->addFlash('success', 'Traitement terminé : ' . $msgMaJemGrille);

        return $this->render('preparation_data/preparation_data.html.twig', [
                'controller_name' => 'PreparationDataController',
        ]);
    }
}
