<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class RechercheMedicamentController extends AbstractController
{
    /**
     * @Route("/recherche_medicament", name="recherche_medicament")
     */
    public function index()
    {
        return $this->render('recherche_medicament/recherche_medicament.html.twig', [
            'controller_name' => 'RechercheMedicamentController',
        ]);
    }

}
