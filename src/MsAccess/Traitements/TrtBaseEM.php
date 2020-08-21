<?php

namespace App\MsAccess\Traitements;

use App\MsAccess\Database\DatabaseAccess;
use App\Entity\EmDenom;
use Doctrine\ORM\EntityManagerInterface;
/**
 * Description of TrtBaseEM
 *
 * @author Frannou
 */
class TrtBaseEM {
    public function test()
    {
        echo "ça marche !!!";
    }
    public function DBaccess()
    {
        $ObjAccess = new DatabaseAccess();
        $ReqAccess=$ObjAccess->RqOccurrenceEm();
//        foreach ($ReqAccess as $value) {
//            var_dump(utf8_encode($value["produit"]));
//            var_dump($value["Nbr"]);
//        }
//        var_dump($ReqAccess[2]);
        dump($ReqAccess[2]["produit"]);
//        die();
        
//        $pdo = DatabaseAccess::getPdoAccess();
//        dump($pdo);
    }
}
