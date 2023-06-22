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
//    public function test()
//    {
//        echo "ça marche !!!";
//    }
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
        $NbEnregParLot = 1000;
        $iCptEnreg = 0;
        $iCptLot = 0;

        $listeInsert = array(); 
        $this->effaceEmDenomV2();
        $ObjAccess = new DatabaseAccess();


// pour test
// $test = $ObjAccess->DonneListe_numBNPV("ZYPREXA 5 mg, comprimé enrobé");
// $test = $ObjAccess->DonneListe_numBNPV('ZYPREXA 5 mg, comprimé enrobé');

// dd($test);

//        $ReqAccess=$ObjAccess->RqOccurrenceEmLimit30();
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
        // dd();
        // $sql = "INSERT INTO em_denom_v2 (denomination, nbr) VALUES ".implode(',', $listeInsert);       
        // $stmt = $this->em->getConnection()->prepare(utf8_encode ($sql));
        // $stmt->execute([]);
    }
    public function effaceEmDenomV2(): void
    {
        $sql = "TRUNCATE em_denom_v2";       
        $stmt = $this->em->getConnection()->prepare($sql);
        $stmt->execute([]);
    }
}
