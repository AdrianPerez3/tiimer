<?php

namespace App\Controller;

use App\Entity\Tiimer;
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

        $tiimer = new Tiimer();
        $form = $this->createForm(TiimerType::class, $tiimer);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $tiimer->setUser($this->getUser());
            $entityManager->persist($tiimer);
            $entityManager->flush();
//            return $this->redirect($request->getUri());
            return $this->redirect('/stadistics');

        }




        return $this->render('tiimer/index.html.twig', [
                "tiimerForm"=>$form->createView()

            ]);
    }

    #[Route('/tiimer/form', name: 'app_tiimer_form')]
    public function tiimerForm(Request $request, EntityManagerInterface $entityManager): Response
    {

        $tiimer = new Tiimer();
        $form = $this->createForm(TiimerType::class, $tiimer);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $tiimer->setUser($this->getUser());
            $entityManager->persist($tiimer);
            $entityManager->flush();
//            return $this->redirect($request->getUri());
            return $this->redirect('/stadistics');

        }




        return $this->render('tiimer/form.html.twig', [
            "tiimerForm"=>$form->createView()

        ]);
    }
}
