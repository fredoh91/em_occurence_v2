<?php

namespace App\Controller;

use App\MsAccess\Traitements\TrtBaseEM;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PreparationDataController extends AbstractController
{
    /**
     * @Route("/preparation_data", name="preparation_data")
     */
    public function PreparationData():Response
    {
        $Trt=new TrtBaseEM();
        $Trt->DBaccess();
        return $this->render('preparation_data/preparation_data.html.twig', [
            'controller_name' => 'PreparationDataController',
        ]);
    }
}
