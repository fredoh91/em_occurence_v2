<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\EmOccProduitV2;
use Symfony\Component\HttpFoundation\Request;
//use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\FormInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class RechercheMedicamentController extends AbstractController
{
    /**
     * @Route("/recherche_medicament", name="recherche_medicament")
     */
    public function searchProduit(Request $request, EntityManagerInterface $em):Response
        {
            $form =$this->createFormBuilder()
                        ->setMethod('GET')
                        ->add('produit',TextType::class)
                        ->add('submit', SubmitType::class, ['label' => 'Recherche d\'un médicament'])
                        ->getForm()
                    ;
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $data = $form->getData();
                
                
        //        $repo = $em->getRepository('App\Entity\EmOccProduitV2');
                $repo = $em->getRepository(EmOccProduitV2::class);
        //        $tousproduits = $repo->findAll();
               // $tousproduits = $repo->findBy(array('produit' => $data['produit']));
                
                $tousproduits = $repo->findLikeQBjoin_v2($data['produit']);
//                dump($tousproduits);
                
                
                
                
                
                 return $this->render('recherche_medicament/recherche_medicament.html.twig', [
                        'form_rech_med' => $form->createView(),
                        'produits'=> $tousproduits
                ]);
                
                
            }
            
            return $this->render('recherche_medicament/recherche_medicament.html.twig', [
            'form_rech_med' => $form->createView(),
            'produits'=> 'Pas de produit'
        ]);
            
            
////        $repo = $em->getRepository('App\Entity\EmOccProduitV2');
//        $repo = $em->getRepository(EmOccProduitV2::class);
////        $tousproduits = $repo->findAll();
//        $tousproduits = $repo->findBy(array('produit' => 'VOLTARENPLAST'));
//         return $this->render('recherche_medicament/recherche_medicament.html.twig', [
//            'controller_name' => 'RechercheMedicamentController',
//             'produits'=> $tousproduits
//        ]);       
        
//        $EmOccProduitV2 = new EmOccProduitV2();
//        dump($EmOccProduitV2);
//        $form = $this->createFormBuilder($EmOccProduitV2)
//                     ->add('produit')
//                     ->getForm();
//        return $this->render('recherche_medicament/recherche_medicament.html.twig',[
//            'formEmOccProduitV2' => $form->createView()
//        ]);
        
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
