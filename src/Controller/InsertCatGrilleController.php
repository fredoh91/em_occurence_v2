<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\EmOccProduitV2;
use App\Entity\GrilleOccEmV2;
use Doctrine\ORM\EntityManagerInterface;
class InsertCatGrilleController extends AbstractController
{
    /**
     * @Route("/insert/cat/grille", name="insert_cat_grille")
     * @param EntityManagerInterface $em
     * @return type
     */
    public function index(EntityManagerInterface $em)
    {
        $repoG = $em->getRepository(GrilleOccEmV2::class);
        $grille= $repoG->find(1);
        $repoP = $em->getRepository(EmOccProduitV2::class);
        $tousproduits = $repoP->findByTypGrill(1);
        
        $repoG = $em->getRepository(GrilleOccEmV2::class);
        $grille= $repoG->find(2);
        $repoP = $em->getRepository(EmOccProduitV2::class);
        $tousproduits = $repoP->findByTypGrill(2);
        
        $repoG = $em->getRepository(GrilleOccEmV2::class);
        $grille= $repoG->find(3);
        $repoP = $em->getRepository(EmOccProduitV2::class);
        $tousproduits = $repoP->findByTypGrill(3);
        
        $repoG = $em->getRepository(GrilleOccEmV2::class);
        $grille= $repoG->find(4);
        $repoP = $em->getRepository(EmOccProduitV2::class);
        $tousproduits = $repoP->findByTypGrill(4);
        
//        for ($i=2;$i<=4;$i++) {
//            $grille= $repoG->find($i);
//            $tousproduits = $repoP->findByTypGrill($i);
//        }



        foreach ($tousproduits as $produit) {
//            dump($repoG);
//            dd($produit);
            $produit->setCatGrille($grille);            
        }
        $em->persist($produit);
        $em->flush();         
        
//        $produit= $repoP->find(1958);

//        dd($tousproduits);
        return $this->render('insert_cat_grille/index.html.twig', [
            'controller_name' => 'InsertCatGrilleController',
        ]);
    }
}
