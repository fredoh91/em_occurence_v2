<?php

namespace App\Controller;

use App\Entity\EmDatePreparationDataV2;
use App\Entity\EmOccProduitV2;
use App\Entity\GrilleOccEmV2;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RechercheMedicamentController extends AbstractController
{
    /**
     * @Route("/recherche_medicament", name="recherche_medicament")
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return Response
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
            
            $repoGrilleOccEmV2 = $em->getRepository(GrilleOccEmV2::class);
            $grille = $repoGrilleOccEmV2->findAll();
            
            $repoDtPrepData = $em->getRepository(EmDatePreparationDataV2::class);
            
//            $tempo = dump($repoDtPrepData->findLast());
            if (null !==($repoDtPrepData->findLast())) {
                //vide
                $DtPrepData = null;
            } else {
                // non vide
                $DtPrepData = $repoDtPrepData->findLast()[0]->getDatePreparationData();
            }
            
            if ($form->isSubmitted() && $form->isValid()) {
                $data = $form->getData();

                $repo = $em->getRepository(EmOccProduitV2::class);
                $tousproduits = $repo->findLikeQBjoin_v2($data['produit']);

                 return $this->render('recherche_medicament/recherche_medicament.html.twig', [
                        'form_rech_med' => $form->createView(),
                        'produits'=> $tousproduits,
                        'DtPrepData'=> $DtPrepData,
                        'grille'=> $grille
                ]);
            }
            
            return $this->render('recherche_medicament/recherche_medicament.html.twig', [
            'form_rech_med' => $form->createView(),
            'produits'=> 'Pas de produit',
            'DtPrepData'=> $DtPrepData,
            'grille'=> $grille
        ]);

    }
}
