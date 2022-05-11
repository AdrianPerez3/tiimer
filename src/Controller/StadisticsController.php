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
        $countByDates  = $entityManager->getRepository(Tiimer::class)->getCountbyDate();

        $fechas = [];
        $count = [];
        $dates = [];
        $total = [];
        foreach ($repositorys as $repository){
            $dates[] = $repository['date'];
            $total[] = $repository['TOTAL'];
        }

        foreach ($countByDates as $countByDate){
            $fechas[] = $countByDate['date'];
            $count[] = $countByDate['count'];
        }


        $linea = $chartBuilder->createChart(Chart::TYPE_LINE);

        $linea->setData([
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

        $linea->setOptions([
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

        $donut = $chartBuilder->createChart(Chart::TYPE_DOUGHNUT);

        $donut->setData([
            'labels' => $fechas,
            'datasets' => [
                [
                    'label' => ['Red', 'Orange', 'Yellow', 'Green', 'Blue'],
                    'backgroundColor' => ['Red', 'Orange', 'Yellow', 'Green', 'Blue', 'black', 'purple', 'brown', 'grey'],
                    'borderColor' => 'rgb(255, 255, 255)',
                    'data' => $count,
                ],
            ],
        ]);

        $donut->setOptions([
            'plugins'=>[
                'title' => [
                    'display'=>true,
                    'text'=>'Trabajos realizados por dia'
                ],
            ]
        ]);

        return $this->render('stadistics/index.html.twig', [
            'chart' => $linea,
            'donut'=>$donut
        ]);

    }

}
