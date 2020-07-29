<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PreparationDataController extends AbstractController
{
    /**
     * @Route("/preparation_data", name="preparation_data")
     */
    public function index()
    {
        return $this->render('preparation_data/preparation_data.html.twig', [
            'controller_name' => 'PreparationDataController',
        ]);
    }
}
