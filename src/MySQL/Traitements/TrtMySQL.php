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
        
    /**
     * crée une table de sauvegarde
     * @param string $nomTable
     * @return void
     */
    public function creeCopieTable(string $nomTable): void
    {
        $sql = "CREATE TABLE " . $nomTable . "_" . $this->sMaintenant . " LIKE $nomTable";       
        $stmt = $this->em->getConnection()->prepare($sql);
        $stmt->execute([]);
    }
    
    /**
     * remplie la table de sauvegarde
     * @param string $nomTable
     * @return void
     */
    public function rempliCopieTable(string $nomTable): void
    {       
        $sql = "INSERT " . $nomTable . "_" . $this->sMaintenant . " SELECT * FROM $nomTable;";
        $stmt = $this->em->getConnection()->prepare($sql);
        $stmt->execute([]);
    }
    
    /**
     * Efface la table passée en paramètre
     * @param string $nomTable
     * @return void
     */
    public function effaceTable(string $nomTable): void
    {
        $sql = "TRUNCATE $nomTable";       
        $stmt = $this->em->getConnection()->prepare($sql);
        $stmt->execute([]);
    }
    
    /**
     * 
     * @param string $nomTable
     * @return void
     */
    public function SauveEtResetTable(string $nomTable): void
    {
        $this->creeCopieTable($nomTable);
        $this->rempliCopieTable($nomTable);
        $this->effaceTable($nomTable);
    }
    
    /**
     * crée une table de sauvegarde et la rempli
     * @param string $nomTable
     * @return void
     */
    public function SauveTable(string $nomTable): void
    {
        $this->creeCopieTable($nomTable);
        $this->rempliCopieTable($nomTable);
    }

    /**
     * Remplissage de la table em_occ_produit_v2
     * @return void
     */
    public function rempliEmOccProduitV2(): void
    {       
        set_time_limit(60);
//      Remplissage de la table em_occ_produit_v2 avec de données factices dans cat_grille_id
        $sql = "INSERT INTO em_occ_produit_v2 (produit, nbr, cat_grille_id) "
             . "SELECT em_denom_map_v2.bn_label AS produit, sum(em_denom_v2.nbr) AS Nbr, 1 AS cat_grille_id "
             . "FROM em_denom_map_v2 "
             . "INNER JOIN em_denom_v2 ON em_denom_map_v2.denomination = em_denom_v2.denomination  "
             . "WHERE em_denom_map_v2.cq <> 'TODO' "
             . "GROUP BY em_denom_map_v2.bn_label  "
             . "ORDER BY 2, 1 DESC;";
        $stmt = $this->em->getConnection()->prepare($sql);
        $stmt->execute();
        
//      Remplissage des bonnes données dans le champ cat_grille_id  
//      Désactivation du check sur les clés étrangères
        $stmt = $this->em->getConnection()->executeQuery("SET FOREIGN_KEY_CHECKS=0;");
        // $stmt->execute();        
 
//      Modif de la catégorie
        $sql = "UPDATE em_occ_produit_v2  "
             . "SET cat_grille_id = ( "
             . "SELECT grille_occ_em_v2.id "
             . "FROM grille_occ_em_v2 "
             . "WHERE em_occ_produit_v2.nbr >= grille_occ_em_v2.vmin "
             . "AND em_occ_produit_v2.nbr <= grille_occ_em_v2.vmax);";
        $stmt = $this->em->getConnection()->prepare($sql);
        $stmt->execute();      

//      Réactivation du check sur les clés étrangères  
        $stmt = $this->em->getConnection()->executeQuery("SET FOREIGN_KEY_CHECKS=1;");
        // $stmt->execute();               
   
    }
    
    /**
     * Remplissage de la table em_occ_produit_v2
     * @return void
     */
    public function rempliEmOccDenoV2(): void
    {       
        set_time_limit(60);
//      Remplissage de la table em_occ_produit_v2 avec de données factices dans cat_grille_id
//        $sql = "INSERT INTO em_occ_produit_v2 (produit, nbr, cat_grille_id) "
//             . "SELECT em_denom_map_v2.bn_label AS produit, sum(em_denom_v2.nbr) AS Nbr, 1 AS cat_grille_id "
//             . "FROM em_denom_map_v2 "
//             . "INNER JOIN em_denom_v2 ON em_denom_map_v2.denomination = em_denom_v2.denomination  "
//             . "WHERE em_denom_map_v2.cq <> 'TODO' "
//             . "GROUP BY em_denom_map_v2.bn_label  "
//             . "ORDER BY 2, 1 DESC;";
        $sql = "INSERT INTO em_occ_deno_v2 (denomination, produit, nbr) "
             . "SELECT em_denom_v2.denomination, em_denom_map_v2.bn_label, sum(em_denom_v2.nbr) "
             . "FROM em_denom_map_v2 "
             . "INNER JOIN em_denom_v2 ON em_denom_map_v2.denomination = em_denom_v2.denomination "
             . "AND em_denom_map_v2.cq <> 'TODO' "
             . "GROUP BY em_denom_v2.denomination "
             . "ORDER BY 3, 2, 1 DESC;";
        $stmt = $this->em->getConnection()->prepare($sql);
        $stmt->execute();
    }
    /**
     * Remplissage de la table em_denom_map_todo_v2
     * @return void
     */
    public function rempliEmDenomMapTodoV2(): void
    {       
        set_time_limit(60);
//      Remplissage de la table em_denom_map_todo_v2 
        $sql = "INSERT INTO em_denom_map_todo_v2 (denomination, nbr) "
             . "SELECT em_denom_v2.denomination,em_denom_v2.nbr "
             . "FROM em_denom_v2 "
             . "LEFT JOIN em_denom_map_v2 ON em_denom_map_v2.denomination=em_denom_v2.denomination "
             . "WHERE em_denom_map_v2.denomination IS NULL;";
        $stmt = $this->em->getConnection()->prepare($sql);
        $stmt->execute();
    }
}
