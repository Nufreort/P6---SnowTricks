<?php

namespace App\Controller;

use App\Entity\Tricks;
use App\Form\TrickType;
use App\Repository\TricksRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class PagesController extends AbstractController
{
    /**
     * @Route("/", name="app_index")
     */
    public function index(TricksRepository $tricksRepository): Response
    {
      $tricks = $tricksRepository->findBy([], ['createdAt' => 'DESC']);

        return $this->render('pages/index.html.twig', compact('tricks'));
    }

    /**
     * @Route("/trick/create", name="app_trickCreate")
     */
    public function create(Request $request, EntityManagerInterface $em): Response
    {
      $trick = new Tricks;

      $form = $this->createForm(TrickType::class, $trick);

      $form->handleRequest($request);

      if($form->isSubmitted() && $form->isValid()){
          $em->persist($trick);
          $em->flush();

          return $this->redirectToRoute('app_index');
      }

      return $this->render('pages/trickCreate.html.twig', [
        'form' => $form->CreateView()
      ]);
    }
    /**
     * @Route("/trick/{id}", name="app_trickView")
     */
    public function trickView(Tricks $tricks): Response
    {
        return $this->render('pages/trickView.html.twig', compact('tricks'));
    }

    /**
     * @Route("/trick/{id}/edit", name="app_trickEdit")
     */
    public function trickEdit(Request $request, Tricks $tricks, EntityManagerInterface $em): Response
    {
            $form = $this->createForm(TrickType::class, $tricks);

            $form->handleRequest($request);

            if($form->isSubmitted() && $form->isValid()){
                $em->flush();

                return $this->redirectToRoute('app_index');
            }

            return $this->render('pages/trickEdit.html.twig', [
              'tricks' => $tricks,
              'form' => $form->CreateView()
            ]);
    }

    /**
     * @Route("/trick/{id}/delete", name="app_trickDelete")
     */
    public function trickDelete(Tricks $tricks, EntityManagerInterface $em): Response
    {
            $em->remove($tricks);
            $em->flush();

            return $this->redirectToRoute('app_index');            
    }
}
