<?php

namespace App\Controller;

use App\Entity\Tiimer;
use App\Repository\TiimerRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Date;
use Symfony\UX\Chartjs\Builder\ChartBuilderInterface;
use Symfony\UX\Chartjs\Model\Chart;

class StadisticsController extends AbstractController
{
    #[Route('/stadistics', name: 'app_stadistics')]
    public function index(ChartBuilderInterface $chartBuilder, ManagerRegistry $entityManager): Response
    {

        $repositorys = $entityManager->getRepository(Tiimer::class)->getTotalTimeOrdered();

        $dates = [];
        $total = [];
        foreach ($repositorys as $repository){
            $dates[] = $repository['date'];
            $total[] = $repository['TOTAL'];
        }

        $chart = $chartBuilder->createChart(Chart::TYPE_LINE);

        $chart->setData([
            'labels' => $dates,
            'datasets' => [
                [
                    'label' => 'Seconds per day',
                    'backgroundColor' => 'rgb(255, 99, 132)',
                    'borderColor' => 'rgb(255, 99, 132)',
                    'data' => $total,
                ],
            ],
        ]);

        $chart->setOptions([
            'scales' => [
                'x'=>[
                    'min' => 0,
                    'max' => 10,
                ],
                'y' => [
                    'suggestedMin' => 0,
                    'suggestedMax' => 20,
                ],
            ],
        ]);
        return $this->render('stadistics/index.html.twig', [
            'chart' => $chart,
        ]);
    }
}
