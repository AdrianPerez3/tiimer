<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StadisticsController extends AbstractController
{
    #[Route('/stadistics', name: 'app_stadistics')]
    public function index(): Response
    {
        return $this->render('stadistics/index.html.twig', [
            'controller_name' => 'StadisticsController',
        ]);
    }
}
