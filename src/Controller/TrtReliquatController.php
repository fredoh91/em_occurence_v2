<?php

namespace App\Controller;

use App\Entity\EmRomediV2;
use App\Form\ModifTodoType;
use App\Entity\EmDenomMapV2;
use App\Form\RechRomediType;
use App\Entity\EmDenomMapTodoV2;
use App\Form\RechRomediParLabelType;
use App\Entity\EMProduitsBaseAccessV2;
use Doctrine\ORM\EntityManagerInterface;
use App\MsAccess\Database\DatabaseAccess;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class TrtReliquatController extends AbstractController
{
    /**
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return Response
     */
    #[Route(path: '/trt_reliquat', name: 'liste_reliquat')]
    public function listeReliquat(Request $request, EntityManagerInterface $em):Response
    {
        $repo = $em->getRepository(EmDenomMapTodoV2::class);

        $todos = $repo->findAll();

        $NbTodos= count($todos);

        // $ObjAccess = new DatabaseAccess();
        
        // /* Ajout du numéro BNPV depuis la base Access, si bcp de cas a traiter, cela peut faire ramer l'affichage de la page */
        // foreach ($todos as $todo) {
        //     $denom_to_find = $todo->getdenomination();
        //     $denom_lst_numBNPV =  $ObjAccess->DonneListe_numBNPV($denom_to_find);
        //     $todo->setLstNumBNPV($denom_lst_numBNPV);
        // }
        // /** fin du truc qui fait ramer */

        
        // $ObjAccess = new DatabaseAccess();
        
        /* Ajout du numéro BNPV depuis la table MySQL, si bcp de cas a traiter, cela peut faire ramer l'affichage de la page */
        
        set_time_limit(360);

        $repo_prod = $em->getRepository(EMProduitsBaseAccessV2::class);
        foreach ($todos as $todo) {
            if (is_null($todo->getLstNumBNPV())) {
                $denom_to_find = $todo->getdenomination();
                $denom_lst_numBNPV =  $repo_prod->DonneListe_numBNPV($denom_to_find);
                $todo->setLstNumBNPV($denom_lst_numBNPV);
                $em->persist($todo);
                $em->flush();
            }
        }
        /** fin du truc qui fait ramer */

        return $this->render('trt_reliquat/trt_reliquat.html.twig', [
            'todos' => $todos,
            'NbTodos' => $NbTodos,
        ]);
    }
    
    /**
     * @param int $id
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return Response
     */
    #[Route(path: '/trt_reliquat/{id}', name: 'modif_reliquat', requirements: ['id' => '\d+'])]
    public function modifReliquat(int $id, Request $request, EntityManagerInterface $em):Response {
        
        $repo = $em->getRepository(EmDenomMapTodoV2::class);
        $reliquat = $repo->find($id);
        
        if (is_null($reliquat->getLstNumBNPV())) {
            
            // // version requete Access
            // $ObjAccess = new DatabaseAccess();
            // $lst_numBNPV =  $ObjAccess->DonneListe_numBNPV($reliquat->getdenomination());
            
            // version requete MySQL
            $repo_prod = $em->getRepository(EMProduitsBaseAccessV2::class);
            $lst_numBNPV =  $repo_prod->DonneListe_numBNPV($reliquat->getdenomination());
            $reliquat->setLstNumBNPV($lst_numBNPV);
            $em->persist($reliquat);
            $em->flush();
        }

        $form = $this->createForm(ModifTodoType::class,$reliquat);
        $formRechRomedi = $this->createForm(RechRomediType::class);
        $formRechRomediParLabel = $this->createForm(RechRomediParLabelType::class);

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
            'formRechRomedi' => $formRechRomedi->createView(),
            'formRechRomediParLabel' => $formRechRomediParLabel->createView()
        ]);
    }
    
    
    /**
     * @param Request $request
     * @param EntityManagerInterface $em
     * @param PaginatorInterface $paginator
     * @return Response
     */
    #[Route(path: '/trt_reliquat/rech_romedi/{id}', name: 'rech_romedi', requirements: ['id' => '\d+'])]
    public function rechRomedi(Request $request, EntityManagerInterface $em, PaginatorInterface $paginator):Response
    {
        $idTodo = $request->attributes->get('id');
        $repo = $em->getRepository(EmRomediV2::class);
        $BN_LabelRech=trim($request->query->get('rech_romedi')['BN_Label']);
        $queryRomedis = $repo->findByProduitQuery($BN_LabelRech);
        
        // Pour affichage du nom du produit recherché dans la vue
        $repo_todo = $em->getRepository(EmDenomMapTodoV2::class);
        $produit_todo = $repo_todo->find($idTodo);
        
        $romedis = $paginator->paginate(
                $queryRomedis,
                $request->query->getInt('page', 1),
                10
                );

        return $this->render('trt_reliquat/rech_romedi.html.twig', [
            'romedis' => $romedis,
            'idTodo' => $idTodo,
            'produit_todo' => $produit_todo
        ]);
    }
    /**
     * @param Request $request
     * @param EntityManagerInterface $em
     * @param PaginatorInterface $paginator
     * @return Response
     */
    #[Route(path: '/trt_reliquat/rech_romedi_par_label/{id}', name: 'rech_romedi_par_label', requirements: ['id' => '\d+'])]
    public function rechRomediParLabel(Request $request, EntityManagerInterface $em, PaginatorInterface $paginator):Response
    {
        $idTodo = $request->attributes->get('id');
        $repo = $em->getRepository(EmRomediV2::class);
        $LabelRech=trim($request->query->get('rech_romedi_par_label')['Label']);
        
//        dd($request->query->get('rech_romedi_par_label'));
        
        $queryRomedis = $repo->findByProduitLabelQuery($LabelRech);
        
        // Pour affichage du nom du produit recherché dans la vue
        $repo_todo = $em->getRepository(EmDenomMapTodoV2::class);
        $produit_todo = $repo_todo->find($idTodo);
        
        $romedis = $paginator->paginate(
                $queryRomedis,
                $request->query->getInt('page', 1),
                10
                );

        return $this->render('trt_reliquat/rech_romedi.html.twig', [
            'romedis' => $romedis,
            'idTodo' => $idTodo,
            'produit_todo' => $produit_todo
        ]);
    }
    
    /**
     * @param int $id
     * @param int $idRomedi
     * @param EntityManagerInterface $em
     * @return type
     */
    #[Route(path: '/trt_reliquat/rech_romedi/{id}/attrib_romedi/{idRomedi}', name: 'attrib_romedi', requirements: ['id' => '\d+', 'idRomedi' => '\d+'])]
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
