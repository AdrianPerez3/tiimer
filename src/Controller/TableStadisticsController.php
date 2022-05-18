<?php

namespace App\Controller;

use App\Entity\Tiimer;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TableStadisticsController extends AbstractController
{
    #[Route('/table', name: 'app_table_stadistics')]
    public function index(ManagerRegistry $entityManager): Response
    {

        $repository = $entityManager->getRepository(Tiimer::class)->getTable($this->getUser());
//        dd($repository);

        return $this->render('table_stadistics/index.html.twig', [
            'table'=>$repository
        ]);
    }
}
