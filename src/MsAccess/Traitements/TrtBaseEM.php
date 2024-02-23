<?php

namespace App\MsAccess\Traitements;

use App\MsAccess\Database\DatabaseAccess;
use App\Entity\EmDenom;
use App\Entity\EmDenomV2;
//use Doctrine\ORM\EntityManagerInterface;
/**
 * Description of TrtBaseEM
 *
 * @author Frannou
 */
class TrtBaseEM {
    private $em;
    function __construct($em)
    {
        $this->em = $em;
    }

    public function importBaseEM()
    {   
        $NbEnregParLot = 1000;
        $iCptEnreg = 0;
        $iCptLot = 0;

        $listeInsert = array(); 
        $this->effaceEmDenomV2();
        $ObjAccess = new DatabaseAccess();

        $ReqAccess=$ObjAccess->RqOccurrenceEm();
        foreach($ReqAccess as $row)
        {
            $iCptEnreg++;
            $produit = $row['produit'];
            $produit = str_replace(CHR(13).CHR(10),"",$produit);
            $produit = str_replace(CHR(34),CHR(39),$produit);

            // $listeInsert[] = '("'.(str_replace(CHR(13).CHR(10),"",$row['produit'])).'", '.$row['Nbr'].')';
            $listeInsert[] = '("'.$produit.'", '.$row['Nbr'].')';
            if ($iCptEnreg > $NbEnregParLot) {
                $iCptLot++;
                // dump($iCptLot);
                $sql = "INSERT INTO em_denom_v2 (denomination, nbr) VALUES ".implode(',', $listeInsert);
                // dump($sql);
                $stmt = $this->em->getConnection()->prepare(utf8_encode ($sql));
                $stmt->execute([]);
                $iCptEnreg = 0;
                $listeInsert = array(); 
            }
        }  
    }

    public function rempliEMProduitsBaseAccessV2()
    {   
        // $NbEnregParLot = 1000;
        // $iCptEnreg = 0;
        // $iCptLot = 0;

        // $listeInsert = array(); 
        // $this->effaceEmDenomV2();
        $ObjAccess = new DatabaseAccess();

        $ReqAccess=$ObjAccess->RqProduitBaseAccessEM();

        foreach($ReqAccess as $row)
        {
            // dump($row);
            // dump($row['denomination']);
            // dd(str_replace(CHR(39),CHR(34),"Solution d'acide acétique à 5 %"));
            $denomination = mb_convert_encoding($row['denomination'], 'UTF-8', 'ISO-8859-1');
            $denomination = str_replace(CHR(13).CHR(10),"",$denomination);
            $denomination = str_replace(CHR(34),CHR(39),$denomination);

            $DCI = mb_convert_encoding($row['DCI'], 'UTF-8', 'ISO-8859-1');
            $DCI = str_replace(CHR(13).CHR(10),"",$DCI);
            $DCI = str_replace(CHR(34),CHR(39),$DCI);

            $dosage = mb_convert_encoding($row['dosage'], 'UTF-8', 'ISO-8859-1');
            $dosage = str_replace(CHR(13).CHR(10),"",$dosage);
            $dosage = str_replace(CHR(34),CHR(39),$dosage);

            $voie = mb_convert_encoding($row['voie'], 'UTF-8', 'ISO-8859-1');
            $voie = str_replace(CHR(13).CHR(10),"",$voie);
            $voie = str_replace(CHR(34),CHR(39),$voie);

            $libATC = mb_convert_encoding($row['libATC'], 'UTF-8', 'ISO-8859-1');
            $libATC = str_replace(CHR(13).CHR(10),"",$libATC);
            $libATC = str_replace(CHR(34),CHR(39),$libATC);
            // dd($denomination);

            set_time_limit(60);
            //  Remplissage de la table em_occ_produit_v2 avec de données factices dans cat_grille_id
            // $sql = "INSERT INTO em_produits_base_access_v2 "
            //         . "(denomination, dci, id_cas, dosage, voie, code_vu, code_atc, lib_atc, numero_crpv) "
            //         . "SELECT em_denom_map_v2.bn_label AS produit, sum(em_denom_v2.nbr) AS Nbr, 1 AS cat_grille_id "
            //         . "FROM em_denom_map_v2 "
            //         . "INNER JOIN em_denom_v2 ON em_denom_map_v2.denomination = em_denom_v2.denomination  "
            //         . "WHERE em_denom_map_v2.cq <> 'TODO' "
            //         . "GROUP BY em_denom_map_v2.bn_label  "
            //         . "ORDER BY 2, 1 DESC;";
                    $sql = "INSERT INTO em_produits_base_access_v2 "
                    . "(denomination,dci) "
                    . "VALUES ( "
                    . CHR(34) . $denomination . CHR(34)
                    . "," . CHR(34) . $DCI . CHR(34)
                    . ");";

                    $sql = "INSERT INTO em_produits_base_access_v2 "
                    . "(denomination, dci, id_cas, dosage, voie, code_vu, code_atc, lib_atc, numero_crpv) "
                    . "VALUES ( "
                    . CHR(34) . $denomination . CHR(34)
                    . "," . CHR(34) . $DCI . CHR(34)
                    . "," . CHR(34) . mb_convert_encoding($row['idCas'], 'UTF-8', 'ISO-8859-1') . CHR(34)
                    . "," . CHR(34) . $dosage . CHR(34)
                    . "," . CHR(34) . $voie . CHR(34)
                    . "," . CHR(34) . mb_convert_encoding($row['codeVU'], 'UTF-8', 'ISO-8859-1') . CHR(34)
                    . "," . CHR(34) . mb_convert_encoding($row['codeATC'], 'UTF-8', 'ISO-8859-1') . CHR(34)
                    . "," . CHR(34) . $libATC . CHR(34)
                    . "," . CHR(34) . mb_convert_encoding($row['numeroCRPV'], 'UTF-8', 'ISO-8859-1') . CHR(34)
                    . ");";

            // dump($sql);
            $stmt = $this->em->getConnection()->prepare($sql);
            $stmt->execute();
        }  
    }





    public function effaceEmDenomV2(): void
    {
        $sql = "TRUNCATE em_denom_v2";       
        $stmt = $this->em->getConnection()->prepare($sql);
        $stmt->execute([]);
    }
}
