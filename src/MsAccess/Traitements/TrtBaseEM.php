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
    public $em;
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
        
        $listeInsert = array(); 
        $this->effaceEmDenomV2();
        $ObjAccess = new DatabaseAccess();
//        $ReqAccess=$ObjAccess->RqOccurrenceEmLimit30();
        $ReqAccess=$ObjAccess->RqOccurrenceEm();

        foreach($ReqAccess as $row)
        {
            $listeInsert[] = '("'.($row['produit']).'", '.$row['Nbr'].')';
        }  
        $sql = "INSERT INTO em_denom_v2 (denomination, nbr) VALUES ".implode(',', $listeInsert);       
        $stmt = $this->em->getConnection()->prepare(utf8_encode ($sql));
        $stmt->execute([]);
    }
    public function effaceEmDenomV2(): void
    {
        $sql = "TRUNCATE em_denom_v2";       
        $stmt = $this->em->getConnection()->prepare($sql);
        $stmt->execute([]);
    }
}
