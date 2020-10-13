<?php

namespace App\MsAccess\Database;

use PDO;
use App\MsAccess\Database\Config;

/**
 * Description of DatabaseAccess
 *
 * @author Frannou
 */
class DatabaseAccess {
//    private static $_instance = null;
    private static $dbAccessName ;
    private static $_instance ;
    private $pdo;
    
    public function __construct()
    {   
        self::$dbAccessName = Config::getInstance()->get('dbAccessName');
        
//        $this->dbAccessName = "D:\Users\Frannou\Dev\Access\CT_Cas\Test\DATA\CT_Cas_2019_be.accdb;";
//        self::$dbAccessName = "D:\Users\Frannou\Dev\Access\EM\Extractions_EM\DATA\Proto_2013_be.accdb;";

        if ($this->pdo === null)
        {
            $this->pdo=new PDO("odbc:DRIVER={Microsoft Access Driver (*.mdb, *.accdb)};charset=UTF-8; DBQ=".self::$dbAccessName."; Uid=; Pwd=;");
        }
    }
    
     /**
     *
     * @return PDO
     */   
    public static function getPdoAccess()
    {
        if (self::$_instance === null) {
            self::$_instance = new PDO("odbc:DRIVER={Microsoft Access Driver (*.mdb, *.accdb)};charset=UTF-8; DBQ=".self::$dbAccessName."; Uid=; Pwd=;");
        }
        return self::$_instance;
    }    

    /**
     * 
     * @return array
     */
    public function RqOccurrenceEm(): array
    {
        $query = "SELECT Produits.denomination AS produit, Count(*) AS Nbr FROM PrincipalCas INNER JOIN Produits ON PrincipalCas.id = Produits.lienCas WHERE (((PrincipalCas.natureErreur) Not In ('NA','NI'))) GROUP BY Produits.denomination ORDER BY Produits.denomination DESC;";
        
        $this->pdoStatment = $this->pdo->prepare($query);
        $this->pdoStatment->execute();
        $this->result = $this->pdoStatment->fetchAll();
        return $this->result;
    }    
    /**
     * 
     * @return array
     */
    public function RqOccurrenceEmLimit30(): array
    {
        $query = "SELECT TOP 30 Produits.denomination AS produit, Count(*) AS Nbr FROM PrincipalCas INNER JOIN Produits ON PrincipalCas.id = Produits.lienCas WHERE (((PrincipalCas.natureErreur) Not In ('NA','NI'))) GROUP BY Produits.denomination ORDER BY Produits.denomination DESC;";
        $this->pdoStatment = $this->pdo->prepare($query);
        $this->pdoStatment->execute();
        $this->result = $this->pdoStatment->fetchAll();
        return $this->result;
    }    
//    /**
//     * 
//     * @return array
//     */
//    public function RqOccurrenceEmInsert30(): array
//    {
//        $query = "SELECT TOP 30 Produits.denomination AS produit, Count(*) AS Nbr FROM PrincipalCas INNER JOIN Produits ON PrincipalCas.id = Produits.lienCas WHERE (((PrincipalCas.natureErreur) Not In ('NA','NI'))) GROUP BY Produits.denomination ORDER BY Produits.denomination DESC;";
//        $this->pdoStatment = $this->pdo->prepare($query);
//        $this->pdoStatment->execute();
//        $this->result = $this->pdoStatment->fetchAll();
//        return $this->result;
//    }
    

}
