<?php

namespace App\Controller;

use App\Entity\Tricks;
use App\Repository\TricksRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class PagesController extends AbstractController
{
    /**
     * @Route("/", name="app_index")
     */
    public function index(TricksRepository $tricksRepository): Response
    {
      $tricks = $tricksRepository->findAll();

        return $this->render('pages/index.html.twig', compact('tricks'));
    }

    /**
     * @Route("/trick/{id}", name="app_trickView")
     */
    public function trickView(Tricks $tricks): Response
    {
        return $this->render('pages/trickView.html.twig', compact('tricks'));
    }
}
