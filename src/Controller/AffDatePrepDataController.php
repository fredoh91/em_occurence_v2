<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\EmDatePreparationData;
use App\Repository\EmDatePreparationDataRepository;

class AffDatePrepDataController extends AbstractController
{
    /**
     * @Route("/aff_date_prep_data", name="aff_date_prep_data")
     */
    public function index(\App\Repository\EmDatePreparationDataRepository $repo)
    {
//        return $this->render('aff_date_prep_data/index.html.twig', [
//            'controller_name' => 'AffDatePrepDataController',
//        ]);
//        $repo=$this->getDoctrine()->getRepository(EmDatePreparationData::class);
        $date_prep = $repo->findAll();
        return $this->render('aff_date_prep_data/DatePrepData.html.twig', [
            'variable_test' => "coucou ça marche",
            'date_prep' => $date_prep
        ]);
    }
    
    /**
     * 
     * @route ("/test/{id}", name= "test_show")
     */
    public function show(EmDatePreparationData $exemple) {
//        $repo = $this->getDoctrine()->getRepository(EmDatePreparationData::class);
//        $exemple = $repo->find($id);
        return $this->render('aff_date_prep_data/DatePrepData_show.html.twig',[
            'variable_test' => "coucou ça marche cette fois aussi",
            'date_prep' => $exemple
        ]);
    }
    
    /**
     * 
     * @Route("/aff_date_prep_data_2",name="DatePrepData_2")
     */
    public function DatePrepData() {
        return $this->render('aff_date_prep_data/DatePrepData.html.twig');
    }
}
