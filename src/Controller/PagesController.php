<?php

namespace App\Controller;

use App\Repository\TricksRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PagesController extends AbstractController
{
    /**
     * @Route("/", name="app_index")
     */
    public function index(TricksRepository $tricksRepository)
    {
      $tricks = $tricksRepository->findAll();

        return $this->render('pages/index.html.twig', compact('tricks'));
    }
}
