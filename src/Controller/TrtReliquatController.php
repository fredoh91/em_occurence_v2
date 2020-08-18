<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class TrtReliquatController extends AbstractController
{
    /**
     * @Route("/trt_reliquat", name="trt_reliquat")
     */
    public function index()
    {
        return $this->render('trt_reliquat/index.html.twig', [
            'controller_name' => 'TrtReliquatController',
        ]);
    }
}
