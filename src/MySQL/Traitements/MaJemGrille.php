<?php

namespace App\MySQL\Traitements;

use App\Entity\EmOccProduitV2;

/**
 * Description of MaJemGrille
 *
 * @author Frannou
 */
class MaJemGrille
{
    private $em;
    private $max;
    private $eff_25;
    private $eff_50;
    private $eff_75;
    private $vmin_1;
    private $vmax_1;
    private $vmin_2;
    private $vmax_2;
    private $vmin_3;
    private $vmax_3;
    private $vmin_4;
    private $vmax_4;
    private $tabNbr;
    private $tabProd;
    private $NbrLigne;
    private $k;
    
    private $grilleCalculee;
    
    function __construct($em)
    {
        $this->em = $em;
    }
    
    /**
     * Calcule les quartiles sur un tableau en fonction du deuxième paramètre passé : 0.25, 0.5, 0.75
     * @param type $Array
     * @param type $pct
     * @return int
     */
    private function Quartile_eff($Array, $pct ) {
    if( count($Array) < 2 ) {
        return 0;
    }

    $total = 0;
    foreach($Array as $value) {
        $total += $value;	
    }

    $sum = 0;
    foreach($Array as $value) {
        $sum += $value;
        if ( $sum/$total >= $pct)
        {
            return $value;
        }
    }
    return 0;
}
    /**
     * donne le contenu de l'entité EmOccProduitV2
     * @return array
     */
    private function donneAllEmOccProduitV2(): array
    {
        
        $EmOccProduitV2Repository = $this->em->getRepository(EmOccProduitV2::class);
        $products = $EmOccProduitV2Repository->findAll();
//        dd(count($products));
        return $products;

//        $sql = "CREATE TABLE " . $nomTable . "_" . $this->sMaintenant . " LIKE $nomTable";       
//        $stmt = $this->em->getConnection()->prepare($sql);
//        $stmt->execute([]);
    }
    
    /**
     * Creation de deux sous-tableaux à partir de la requête sur l'entité EmOccProduitV2
     * @return void
     */
    private function creeDeuxTableaux():int
    {
        $k=0;
        $products = $this->donneAllEmOccProduitV2();
        foreach ($products as $product) {
//            $product[$k]
            
            $this->tabNbr[$k] = $product->getNbr();
            $this->tabProd[$k] = $product->getProduit();
            $k++;
        }
        $this->max = $this->tabNbr[$k-1];

        return $k;
    }
    
    /**
     * Met à jour la table de la grille d'occurence
     * @return void
     */
    private function MajTable(): void
    {
        $sql = "UPDATE grille_occ_em_v2 SET vmin=$this->vmin_1, vmax=$this->vmax_1 WHERE cat_idx=1;";
        $stmt = $this->em->getConnection()->prepare($sql);
        $stmt->execute();   
        $sql = "UPDATE grille_occ_em_v2 SET vmin=$this->vmin_2, vmax=$this->vmax_2 WHERE cat_idx=2;";
        $stmt = $this->em->getConnection()->prepare($sql);
        $stmt->execute();   
        $sql = "UPDATE grille_occ_em_v2 SET vmin=$this->vmin_3, vmax=$this->vmax_3 WHERE cat_idx=3;";
        $stmt = $this->em->getConnection()->prepare($sql);
        $stmt->execute();   
        $sql = "UPDATE grille_occ_em_v2 SET vmin=$this->vmin_4, vmax=$this->vmax_4 WHERE cat_idx=4;";
        $stmt = $this->em->getConnection()->prepare($sql);
        $stmt->execute();             
    }
    public function MaJ()
    {
        $this->k=$this->creeDeuxTableaux();
        $this->eff_25 = $this->Quartile_eff($this->tabNbr,0.25);
        $this->eff_50 = $this->Quartile_eff($this->tabNbr,0.50);
        $this->eff_75 = $this->Quartile_eff($this->tabNbr,0.75);
        $this->vmin_1 = 1;
        $this->vmax_1 = $this->eff_25;
        $this->vmin_2 = $this->eff_25 + 1 ;
        $this->vmax_2 = $this->eff_50 ;
        $this->vmin_3 = $this->eff_50 + 1 ;
        $this->vmax_3 = $this->eff_75 ;
        $this->vmin_4 = $this->eff_75 + 1 ;
        $this->vmax_4 = $this->max + 1 ;
        $this->MajTable();
        
        
        $this->grilleCalculee= "Effectif 25% : $this->eff_25" . 
                       ", Effectif 50% : $this->eff_50" .
                       ", Effectif 75% : $this->eff_75" .
                       ", Max : $this->max " .
                       ", Produit : " . $this->tabProd[(($this->k) - 1)];
//        $this->grilleCalculee= $this->tabProd[(($this->k) - 1)];
        return $this->grilleCalculee;

    }
 
}
