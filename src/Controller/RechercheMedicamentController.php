<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\EmOccProduit;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\FormInterface;

class RechercheMedicamentController extends AbstractController
{
    /**
     * @Route("/recherche_medicament", name="recherche_medicament")
     */
    public function searchProduit(Request $request, ObjectManager $manager) {
        $EmOccProduit = new EmOccProduit();
        
        $form = $this->createFormBuilder($EmOccProduit)
                     ->add('produit')
                     ->getForm();
        return $this->render('recherche_medicament/recherche_medicament.html.twig',[
            'formEmOccProduit' => $form->createView()
        ]);
        
    }
    
//    /**
//     * @Route("/recherche_medicament", name="recherche_medicament")
//     */    
//    public function index()
//    {
//        return $this->render('recherche_medicament/recherche_medicament.html.twig', [
//            'controller_name' => 'RechercheMedicamentController',
//        ]);
//    }
}
