<?php

namespace App\Controller;

use App\Entity\EmDatePreparationData;
use App\Repository\EmDatePreparationDataRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AffDatePrepDataController extends AbstractController
{
    /**
     * @param EmDatePreparationDataRepository $repo
     * @return type
     */
    #[Route(path: '/aff_date_prep_data', name: 'aff_date_prep_data')]
    public function index(EmDatePreparationDataRepository $repo):Response
    {
        $date_prep = $repo->findAll();
        return $this->render('aff_date_prep_data/DatePrepData.html.twig', [
            'variable_test' => "coucou ça marche",
            'date_prep' => $date_prep
        ]);
    }
    
    /**
     *
     * @param EmDatePreparationData $exemple
     * @return type
     */
    #[route(path: '/test/{id}', name: 'test_show')]
    public function show(EmDatePreparationData $exemple):Response {
        return $this->render('aff_date_prep_data/DatePrepData_show.html.twig',[
            'variable_test' => "coucou ça marche cette fois aussi",
            'date_prep' => $exemple
        ]);
    }
    
    #[Route(path: '/aff_date_prep_data_2', name: 'DatePrepData_2')]
    public function DatePrepData():Response {
        return $this->render('aff_date_prep_data/DatePrepData.html.twig');
    }
}
