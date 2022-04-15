<?php

namespace App\Controller;

use App\Entity\Tiimer;
use App\Entity\User;
use App\Form\TiimerType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TiimerController extends AbstractController
{
    #[Route('/tiimer', name: 'app_tiimer')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {

        $user = new User();
        $tiimer = new Tiimer();
        $form = $this->createForm(TiimerType::class, $tiimer);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
//            $tiimer->setUser($user->getId());
            $entityManager->persist($user);
            $entityManager->flush();
        }



            return $this->render('tiimer/index.html.twig', [
            'tiimerForm' => $form->createView(),
        ]);
    }
}
