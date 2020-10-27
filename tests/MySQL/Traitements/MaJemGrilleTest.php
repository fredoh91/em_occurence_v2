<?php

namespace App\MySQL\Traitements;

use PHPUnit\Framework\TestCase;

/**
 * Description of MaJemGrille
 *
 * @author Frannou
 */
class MaJemGrilleTest extends TestCase
{
    //put your code here
    /**
     * 
     * @param type $Array
     * @param type $Quartile
     * @return array
     */
    private function Quartile($Array, $Quartile): array 
    {	
        $pos = (count($Array) - 1) * $Quartile;	
        $base = floor($pos);
        $rest = $pos - $base;

        if( isset($Array[$base+1]) ) {
            return $Array[$base] + $rest * ($Array[$base+1] - $Array[$base]);
        } else {
            return $Array[$base];
        }
    }
 
}
