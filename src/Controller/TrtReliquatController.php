<?php

namespace App\Controller;

use App\Entity\EmDenomMapTodoV2;
use App\Entity\EmDenomMapV2;
use App\Entity\EmRomediV2;
use App\Form\ModifTodoType;
use App\Form\RechRomediType;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class TrtReliquatController extends AbstractController
{
    /**
     * @Route("/trt_reliquat", name="liste_reliquat")
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return Response
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
     * @param int $id
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return Response
     */
    public function modifReliquat(int $id, Request $request, EntityManagerInterface $em):Response {
        
       
        $repo = $em->getRepository(EmDenomMapTodoV2::class);
        $reliquat = $repo->find($id);
        $form = $this->createForm(ModifTodoType::class,$reliquat);
        $formRechRomedi = $this->createForm(RechRomediType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            
            // Ajout d'une ligne dans EmDenomMapV2
            $denomMap=new EmDenomMapV2;
            $denomMap->setDenomination($data->getDenomination());
            $denomMap->setBNLabel($data->getBNLabel());
            $denomMap->setLabel($data->getLabel());
            $denomMap->setCIS($data->getCIS());
            $denomMap->setATC7($data->getATC7());
            $denomMap->setCategorie($data->getCategorie());
            $denomMap->setCQ("1");
            $em->persist($denomMap);
            
            // Effacement de la ligne dans EmDenomMapTodoV2
            $em->remove($reliquat);
            
            $em->flush();
            
            // Message flash pour avertir l'utilisateur
            $this->addFlash('success', 'L\'EM ayant pour dénomination '.$data->getDenomination().' a été mappée avec le BN_Label '.$data->getBNLabel());
            
            // redirection vers la route liste_reliquat , la liste des EM à mapper
            return $this->redirectToRoute('liste_reliquat');

        } 

        return $this->render('trt_reliquat/modif_reliquat.html.twig', [
            'reliquat' => $reliquat,
            'form' => $form->createView(),
            'formRechRomedi' => $formRechRomedi->createView()
        ]);
    }
    /**
     * @Route("/trt_reliquat/rech_romedi/{id}", name="rech_romedi", requirements={"id"="\d+"})
     * @param Request $request
     * @param EntityManagerInterface $em
     * @param PaginatorInterface $paginator
     * @return Response
     */
    public function rechRomedi(Request $request, EntityManagerInterface $em, PaginatorInterface $paginator):Response
    {
        $idTodo = $request->attributes->get('id');
        $repo = $em->getRepository(EmRomediV2::class);
        $BN_LabelRech=$request->query->get('rech_romedi')['BN_Label'];
        $queryRomedis = $repo->findByProduitQuery($BN_LabelRech);
        
        $romedis = $paginator->paginate(
                $queryRomedis,
                $request->query->getInt('page', 1),
                10
                );

        return $this->render('trt_reliquat/rech_romedi.html.twig', [
            'romedis' => $romedis,
            'idTodo' => $idTodo
        ]);
    }
    
    /**
     *  @Route("/trt_reliquat/rech_romedi/{id}/attrib_romedi/{idRomedi}", name="attrib_romedi", requirements={
     * "id"="\d+",
     * "idRomedi"="\d+"
     * })
     * @param int $id
     * @param int $idRomedi
     * @param EntityManagerInterface $em
     * @return type
     */
    public function attribRomedi(int $id, int $idRomedi, EntityManagerInterface $em) {
        // edition de l'entité EmDenomMapTodoV2 ayant pour id $id en y mettant les données de l'entité EmRomediV2 ayant pour id $idRomedi
        $repoTodo = $em->getRepository(EmDenomMapTodoV2::class);
        $todo = $repoTodo->find($id);
        $repoRomedi = $em->getRepository(EmRomediV2::class);
        $Romedi = $repoRomedi->find($idRomedi);
        $todo->setBNLabel($Romedi->getBNLabelRomedi())
             ->setLabel($Romedi->getLabel())
             ->setATC7($Romedi->getATC7())
             ->setCIS($Romedi->getCIS());
        $em->persist($todo);
        $em->flush();
        
        // redirection vers la route rech_romedi avec id $id 
        return $this->redirectToRoute('modif_reliquat', ['id' => $id]);
    }
}
