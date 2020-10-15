<?php

namespace App\MySQL\Traitements;

use App\Entity\EmDenom;
use App\Entity\EmDenomV2;
use App\Entity\EmOccProduitV2;
use App\Entity\GrilleOccEmV2;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
//use Doctrine\ORM\EntityManagerInterface;
/**
 * Description of TrtBaseEM
 *
 * @author Frannou
 */
class TrtMySQL {
    private $em;
    private $sMaintenant;
    function __construct($em)
    {
        $this->em = $em;
        $this->sMaintenant = date("Ymd_His");
    }
    public function test()
    {
//        echo "ça marche !!!";
        dump($this->sMaintenant);
    }
//    public function DBaccess()
//    {
//        $ObjAccess = new DatabaseAccess();
//        $ReqAccess=$ObjAccess->RqOccurrenceEm();
////        foreach ($ReqAccess as $value) {
////            var_dump(utf8_encode($value["produit"]));
////            var_dump($value["Nbr"]);
////        }
////        var_dump($ReqAccess[2]);
//        dump($ReqAccess[2]["produit"]);
////        die();
//        
////        $pdo = DatabaseAccess::getPdoAccess();
////        dump($pdo);
//    }
//    public function ExtractionAccessOccEM()
//    {
//        $ObjAccess = new DatabaseAccess();
////        $ReqAccess=$ObjAccess->RqOccurrenceEm();
//        $ReqAccess=$ObjAccess->RqOccurrenceEmLimit30();
//        dump(count($ReqAccess));
//    }
    public function importBaseEM()
    {   
        
        $listeInsert = array(); 
        $this->effaceEmDenomV2();
        $ObjAccess = new DatabaseAccess();
//        $ReqAccess=$ObjAccess->RqOccurrenceEmLimit30();
        $ReqAccess=$ObjAccess->RqOccurrenceEm();
        foreach($ReqAccess as $row)
        {
//            $listeInsert[] = '("'.($row['produit']).'", '.$row['Nbr'].')';
            $listeInsert[] = '("'.(str_replace(CHR(13).CHR(10),"",$row['produit'])).'", '.$row['Nbr'].')';
        }  
        $sql = "INSERT INTO em_denom_v2 (denomination, nbr) VALUES ".implode(',', $listeInsert);       
        $stmt = $this->em->getConnection()->prepare(utf8_encode ($sql));
        $stmt->execute([]);
    }
        
    public function creeCopieTable(string $nomTable): void
    {
        $sql = "CREATE TABLE " . $nomTable . "_" . $this->sMaintenant . " LIKE $nomTable";       
        $stmt = $this->em->getConnection()->prepare($sql);
        $stmt->execute([]);
    }
        
    public function rempliCopieTable(string $nomTable): void
    {       
        $sql = "INSERT " . $nomTable . "_" . $this->sMaintenant . " SELECT * FROM $nomTable;";
        $stmt = $this->em->getConnection()->prepare($sql);
        $stmt->execute([]);
    }
    
    
    public function effaceTable(string $nomTable): void
    {
        $sql = "TRUNCATE $nomTable";       
        $stmt = $this->em->getConnection()->prepare($sql);
        $stmt->execute([]);
    }

    public function SauveEtResetTable(string $nomTable): void
    {
        $this->creeCopieTable($nomTable);
        $this->rempliCopieTable($nomTable);
        $this->effaceTable($nomTable);
    }
    public function SauveTable(string $nomTable): void
    {
        $this->creeCopieTable($nomTable);
        $this->rempliCopieTable($nomTable);
    }
        
    public function rempliEmOccProduitV2(): void
    {       


//        Remplissage de la table em_occ_produit_v2 avec de données factices dans cat_grille_id
        $sql = "INSERT INTO em_occ_produit_v2 (produit, nbr, cat_grille_id) "
             . "SELECT em_denom_map_v2.bn_label AS produit, sum(em_denom_v2.nbr) AS Nbr, 1 AS cat_grille_id "
             . "FROM em_denom_map_v2 "
             . "INNER JOIN em_denom_v2 ON em_denom_map_v2.denomination = em_denom_v2.denomination  "
             . "WHERE em_denom_map_v2.cq <> 'TODO' "
             . "GROUP BY em_denom_map_v2.bn_label  "
             . "ORDER BY 2, 1 DESC;";
//        $stmt = $this->em->getConnection()->prepare($sql);
//        $stmt->execute([]);
        
//        Remplissage des bonnes données dans le champ cat_grille_id     
        set_time_limit(500);
        $repoG = $this->em->getRepository(GrilleOccEmV2::class);
        $repoP = $this->em->getRepository(EmOccProduitV2::class);
        
        $tousproduits = $repoP->findAll();
//        dump($tousproduits[0]->getNbr());
//
//        dump($repoG->findByValGrill(2));
        foreach ($tousproduits as $produit) {
            
            $grille=$repoG->findByValGrill($produit->getNbr());

           dump($grille[0]) ;
//            dd($produit);
//            dd($tableau->getCatIdx());
//            $produit->setCatGrille($grille[0]);            
        }
//        for ($iCpt=1;$iCpt<=4;$iCpt++) {   
//            
//            $grille= $repoG->find($iCpt);
//            $tousproduits = $repoP->findByTypGrill($iCpt);
//            foreach ($tousproduits as $produit) {
//                $produit->setCatGrille($grille);            
//            }
//            
            $this->em->persist($produit);
            $this->em->flush();             
//            
//        }        
    }
    
    
//    public function effaceEmOccDenoV2(): void
//    {
//        $sql = "TRUNCATE em_occ_deno_v2";       
//        $stmt = $this->em->getConnection()->prepare($sql);
//        $stmt->execute([]);
//    }
//    public function effaceEmGrilleOccV2(): void
//    {
//        $sql = "TRUNCATE em_grille_occ_v2";       
//        $stmt = $this->em->getConnection()->prepare($sql);
//        $stmt->execute([]);
//    }
}
