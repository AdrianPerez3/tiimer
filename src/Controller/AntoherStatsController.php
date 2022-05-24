<?php

namespace App\Controller;

use App\Entity\Tiimer;
use App\Entity\User;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AntoherStatsController extends AbstractController
{
    #[Route('/stats', name: 'app_antoher_stats')]
    public function index(ManagerRegistry $entityManager): Response
    {

        $sumChecked = $entityManager->getRepository(Tiimer::class)->getCountCheckedOfLast30Days($this->getUser());
        $totalTime = $entityManager->getRepository(Tiimer::class)->getTotalTime($this->getUser())[0]['TOTAL'];
        $getAllChecked = $entityManager->getRepository(Tiimer::class)->getAllChecked($this->getUser());
        $getDayMoreActivity = $entityManager->getRepository(Tiimer::class)->getDayMoreActivity($this->getUser())[0]['date'];
        $getBestUser = $entityManager->getRepository(Tiimer::class)->getBestUser()[0]['idUser'];
        $bestUser = $entityManager->getRepository(User::class)->find($getBestUser)->getName();
        $totalGetAllChecked = ($getAllChecked[0]['Checked']/$getAllChecked[0]['Unchecked'])*100;
        $totalTime = gmdate("H:i:s", $totalTime);


        return $this->render('antoher_stats/index.html.twig', [
            'statChecked'=>$sumChecked[0]['Checked'],
            'statUnchecked'=>$sumChecked[0]['Unchecked'],
            'totalTime'=>$totalTime,
            'totalWorkDone'=>$totalGetAllChecked,
            'getDayMoreActivity'=>$getDayMoreActivity,
            'getBestUser'=>$bestUser
        ]);
    }
}
