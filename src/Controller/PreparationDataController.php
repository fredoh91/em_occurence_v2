<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\MsAccess\Traitements\TrtBaseEM;

class PreparationDataController extends AbstractController
{
    /**
     * @Route("/preparation_data", name="preparation_data")
     */
    public function PreparationData()
    {   

    
        $Trt=new TrtBaseEM();
//        $Trt->test();
        $Trt->DBaccess();
        return $this->render('preparation_data/preparation_data.html.twig', [
            'controller_name' => 'PreparationDataController',
        ]);
    }
}
