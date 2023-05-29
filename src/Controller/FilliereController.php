<?php

namespace App\Controller;

use App\Entity\Filliere;
use App\Form\Filliere1Type;
use App\Repository\FilliereRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/filliere')]
class FilliereController extends AbstractController
{
    #[Route('/', name: 'app_filliere_index', methods: ['GET'])]
    public function index(FilliereRepository $filliereRepository): Response
    {
        return $this->render('filliere/index.html.twig', [
            'fillieres' => $filliereRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_filliere_new', methods: ['GET', 'POST'])]
    public function new(Request $request, FilliereRepository $filliereRepository): Response
    {
        $filliere = new Filliere();
        $form = $this->createForm(Filliere1Type::class, $filliere);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $filliereRepository->save($filliere, true);

            return $this->redirectToRoute('app_filliere_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('filliere/new.html.twig', [
            'filliere' => $filliere,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_filliere_show', methods: ['GET'])]
    public function show(Filliere $filliere): Response
    {
        return $this->render('filliere/show.html.twig', [
            'filliere' => $filliere,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_filliere_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Filliere $filliere, FilliereRepository $filliereRepository): Response
    {
        $form = $this->createForm(Filliere1Type::class, $filliere);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $filliereRepository->save($filliere, true);

            return $this->redirectToRoute('app_filliere_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('filliere/edit.html.twig', [
            'filliere' => $filliere,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_filliere_delete', methods: ['POST'])]
    public function delete(Request $request, Filliere $filliere, FilliereRepository $filliereRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$filliere->getId(), $request->request->get('_token'))) {
            $filliereRepository->remove($filliere, true);
        }

        return $this->redirectToRoute('app_filliere_index', [], Response::HTTP_SEE_OTHER);
    }
}
