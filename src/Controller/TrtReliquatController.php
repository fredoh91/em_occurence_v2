<?php

namespace App\Controller;

use App\Entity\EmDenomMapTodoV2;
use App\Form\ModifTodoType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TrtReliquatController extends AbstractController
{
    /**
     * @Route("/trt_reliquat", name="liste_reliquat")
     */
    public function listeReliquat(Request $request, EntityManagerInterface $em):Response
    {
        $repo = $em->getRepository(EmDenomMapTodoV2::class);

        $todos = $repo->findAll();
        return $this->render('trt_reliquat/trt_reliquat.html.twig', [
            'todos' => $todos
        ]);
    }
    
    /**
     * @Route("/trt_reliquat/{id}", name="modif_reliquat", requirements={"id"="\d+"})
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return Response
     */
    public function modifReliquat(int $id, Request $request, EntityManagerInterface $em):Response {
        $repo = $em->getRepository(EmDenomMapTodoV2::class);
        $reliquat = $repo->find($id);
        $form = $this->createForm(ModifTodoType::class,$reliquat);

        return $this->render('trt_reliquat/modif_reliquat.html.twig', [
            'reliquat' => $reliquat,
            'form' => $form->createView()
        ]);
    }
    /**
     * @Route("/trt_reliquat/rech_romedi/{id}", name="rech_romedi", requirements={"id"="\d+"})
     */
    public function rechRomedi(Request $request, EntityManagerInterface $em):Response
    {
        $repo = $em->getRepository(EmRomediV2::class);

        $romedis = $repo->findAll();
        return $this->render('trt_reliquat/rech_romedi.html.twig', [
            'romedis' => $romedis
        ]);
    }
}
