<?php

namespace App\Controller;

use App\Entity\NoteFrais;
use App\Form\NoteFraisType;
use App\Repository\NoteFraisRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class NoteFraisController extends AbstractController
{
    #[Route('/dashboard', name: 'app_note_frais_index', methods: ['GET'])]
    public function index(NoteFraisRepository $noteFraisRepository): Response
    {
        return $this->render('note_frais/index.html.twig', [
            'note_frais' => $noteFraisRepository->findAll(),
        ]);
    }

    #[Route('/dashboard/nouvelle-note-de-frais', name: 'app_note_frais_new', methods: ['GET', 'POST'])]
    public function new(Request $request, NoteFraisRepository $noteFraisRepository): Response
    {
        $noteFrai = new NoteFrais();
        $form = $this->createForm(NoteFraisType::class, $noteFrai);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $noteFraisRepository->add($noteFrai, true);

            return $this->redirectToRoute('app_note_frais_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('note_frais/new.html.twig', [
            'note_frai' => $noteFrai,
            'form' => $form,
        ]);
    }

    #[Route('/dashboard/visualiser/{id}/note-de-frais', name: 'app_note_frais_show', methods: ['GET'])]
    public function show(NoteFrais $noteFrai): Response
    {
        return $this->render('note_frais/show.html.twig', [
            'note_frai' => $noteFrai,
        ]);
    }

    #[Route('/dashboard/{id}/editer-note-de-frais', name: 'app_note_frais_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, NoteFrais $noteFrai, NoteFraisRepository $noteFraisRepository): Response
    {
        $form = $this->createForm(NoteFraisType::class, $noteFrai);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $noteFraisRepository->add($noteFrai, true);

            return $this->redirectToRoute('app_note_frais_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('note_frais/edit.html.twig', [
            'note_frai' => $noteFrai,
            'form' => $form,
        ]);
    }

    #[Route('/dashboard/{id}/supprimer-note-de-frais', name: 'app_note_frais_delete', methods: ['POST'])]
    public function delete(Request $request, NoteFrais $noteFrai, NoteFraisRepository $noteFraisRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$noteFrai->getId(), $request->request->get('_token'))) {
            $noteFraisRepository->remove($noteFrai, true);
        }

        return $this->redirectToRoute('app_note_frais_index', [], Response::HTTP_SEE_OTHER);
    }
}
