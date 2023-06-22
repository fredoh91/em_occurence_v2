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
		// var_dump(self::$dbAccessName);
		// var_dump("odbc:DRIVER={Microsoft Access Driver (*.mdb, *.accdb)};charset=UTF-8; DBQ=".self::$dbAccessName."; Uid=; Pwd=;");
		// die();
            $this->pdo=new PDO("odbc:DRIVER={Microsoft Access Driver (*.mdb, *.accdb)};charset=UTF-8; DBQ=".self::$dbAccessName."; Uid=; Pwd=;");
            // $this->pdo->exec('SET NAMES utf8');
            // $this->pdo->exec('SET CHARACTER SET utf8');            
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
     * Retourne une liste de codes BNPV correspondant aux produit passé en paramètre
     * triée du plus récent au plus ancien. Ainsi le premier numéro qui s'affiche a de bonnes chances de correspondre au cas a mapper
     *
     * @param string $deno : nom du produit à chrcher dans la table "Produits" de la base Access Erreur Med
     * @param integer|null $iNbNum : nombre de numero BNPV maximum, retournés. Si ce paraètre est omis on ne retourne que les 5 plus récent.
     * @return string : par défaut, les numéro BNPV des 5 cas les plus récents 
     */
    public function DonneListe_numBNPV(string $deno, ?int $iNbNum = 5): string
    {
        $deno = mb_convert_encoding($deno,"Windows-1252");      // Par défaut, Access ne gère pas ses requêtes en UTF-8

        $query = "SELECT PrincipalCas.id, PrincipalCas.numeroCRPV, Produits.denomination ";
        $query .= "FROM PrincipalCas INNER JOIN Produits ON PrincipalCas.id = Produits.lienCas ";
        $query .= "WHERE Produits.denomination = '" . $deno . "' ";
        $query .= "AND PrincipalCas.natureErreur Not In ('NA','NI') ";
        $query .= "AND PrincipalCas.numeroCRPV Is Not Null ";
        $query .= "ORDER BY PrincipalCas.id DESC;";

        $this->pdoStatment = $this->pdo->prepare($query );
        $this->pdoStatment->execute();
        $results = $this->pdoStatment->fetchAll();

        $iCpt = 0;
        $LstNumCRPV = '';
        foreach($results as $result) {
            $iCpt ++;
            if($iCpt > $iNbNum){
                    break;
            }
            $LstNumCRPV .= $LstNumCRPV === '' ? $result['numeroCRPV'] : ','.$result['numeroCRPV'] ;
            // $LstNumCRPV .= $LstNumCRPV === '' ? $result['numeroCRPV'] : "\n". $result['numeroCRPV'] ;
            
        }
        
        // $LstNumCRPV = nl2br($LstNumCRPV );
        return $LstNumCRPV;
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
