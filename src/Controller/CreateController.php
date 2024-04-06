<?php

namespace App\Controller;

use App\Entity\Marche;
use App\Form\MarcheType;
use App\Repository\MarcheRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/create')]
class CreateController extends AbstractController
{
    #[Route('/', name: 'app_create_index', methods: ['GET'])]
    public function index(MarcheRepository $marcheRepository): Response
    {
        return $this->render('create/index.html.twig', [
            'marches' => $marcheRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_create_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $marche = new Marche();
        $form = $this->createForm(MarcheType::class, $marche);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($marche);
            $entityManager->flush();

            return $this->redirectToRoute('app_create_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('create/new.html.twig', [
            'marche' => $marche,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_create_show', methods: ['GET'])]
    public function show(Marche $marche): Response
    {
        return $this->render('create/show.html.twig', [
            'marche' => $marche,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_create_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Marche $marche, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(MarcheType::class, $marche);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_create_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('create/edit.html.twig', [
            'marche' => $marche,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_create_delete', methods: ['POST'])]
    public function delete(Request $request, Marche $marche, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$marche->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($marche);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_create_index', [], Response::HTTP_SEE_OTHER);
    }
}
