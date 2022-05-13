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

        $formato = 'd/m/Y';
        foreach ($repositorys as $repository){
            $dates[] = date($formato,strtotime($repository['date']));
            $total[] = $repository['TOTAL'];
        }

        foreach ($countByDates as $countByDate){
            $fechas[] = date($formato,strtotime($countByDate['date']));
            $count[] = $countByDate['count'];
        }

//        if (count($fechas) > 7 && count($count) > 7){
//            unset($fechas[0], $count[0]);
//        }

//        dd($fechas, $count);


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
                    'backgroundColor' => ['rgb(213, 241, 224)', 'rgb(147, 220, 175)', 'rgb(133, 144, 247)', 'rgb(151, 161, 249)', 'rgb(233, 218, 210)', 'rgb(244, 234, 228)', 'rgb(224, 187, 228)', 'rgb(149, 125, 173)', 'rgb(210, 145, 188)', 'rgb(254, 200, 216)', 'rgb(255, 223, 211)'],
                    'borderColor' => 'rgb(255, 255, 255)',
                    'data' => $count,
                ],
            ],
        ]);

        $donut->setOptions([
            'responsive'=> true,
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
