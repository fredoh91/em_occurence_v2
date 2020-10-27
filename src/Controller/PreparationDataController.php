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
    /**
     * @Route("/preparation_data", name="preparation_data")
     */
    public function PreparationData(EntityManagerInterface $em):Response
    {
        // import des données Access : $TrtAccess->importBaseEM();
        $TrtAccess=new TrtBaseEM($em);    // a réactiver en PROD
        $TrtAccess->importBaseEM();    // a réactiver en PROD

        // sauvegardes des tables MySQL : $TrtMySQL->sauvegardeTables();
        $TrtMySQL=new TrtMySQL($em);
        $TrtMySQL->SauveEtResetTable("em_occ_produit_v2");// a réactiver en PROD
        $TrtMySQL->SauveEtResetTable("em_occ_deno_v2");// a réactiver en PROD

        $TrtMySQL->SauveTable("grille_occ_em_v2");// a réactiver en PROD
//        // Mise à jour des tables MySQL : $TrtMySQL->MajTables();// a réactiver en PROD
        $TrtMySQL->rempliEmOccProduitV2();// a réactiver en PROD

        $TrtMySQL->rempliEmOccDenoV2();// a réactiver en PROD
        
//        Mise à jour de la grille 
        $MaJemGrille=new MaJemGrille($em);
        $msgMaJemGrille = $MaJemGrille->MaJ();
//        dd($msgMaJemGrille);
        
//        mise à jour de la table "todo"
        $TrtMySQL->effaceTable("em_denom_map_todo_v2");
        $TrtMySQL->rempliEmDenomMapTodoV2();
//        dump($msgMaJemGrille);
        
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
