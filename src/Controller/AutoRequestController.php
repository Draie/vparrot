<?php

namespace App\Controller;

use App\Entity\AutoRequest;
use App\Form\AutoRequestType;
use App\Repository\AutoRequestRepository;
use App\Repository\HoraireRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/auto/demand')]
class AutoRequestController extends AbstractController
{
    #[Route('/', name: 'app_auto_request_index', methods: ['GET'])]
    public function index(AutoRequestRepository $autoRequestRepository, HoraireRepository $horaire): Response
    {
        return $this->render('auto_request/index.html.twig', [
            'auto_requests' => $autoRequestRepository->findAll(),
            'horairedujour'=>$horaire->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_auto_request_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, HoraireRepository $horaire): Response
    {
        $autoRequest = new AutoRequest();
        $form = $this->createForm(AutoRequestType::class, $autoRequest);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($autoRequest);
            $entityManager->flush();
            $this->addFlash('Succès', 'Votre demande à bien été envoyée');

            return $this->redirectToRoute('app_auto', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('auto_request/new.html.twig', [
            'auto_request' => $autoRequest,
            'form' => $form,
            'horairedujour'=>$horaire->findAll(),
        ]);
    }

    #[Route('/{id}', name: 'app_auto_request_show', methods: ['GET'])]
    public function show(AutoRequest $autoRequest, HoraireRepository $horaire): Response
    {
        return $this->render('auto_request/show.html.twig', [
            'auto_request' => $autoRequest,
            'horairedujour'=>$horaire,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_auto_request_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, AutoRequest $autoRequest, EntityManagerInterface $entityManager, HoraireRepository $horaire): Response
    {
        $form = $this->createForm(AutoRequestType::class, $autoRequest);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_auto_request_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('auto_request/edit.html.twig', [
            'auto_request' => $autoRequest,
            'form' => $form,
            'horairedujour'=>$horaire->findAll()
        ]);
    }

    #[Route('/{id}', name: 'app_auto_request_delete', methods: ['POST'])]
    public function delete(Request $request, AutoRequest $autoRequest, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$autoRequest->getId(), $request->request->get('_token'))) {
            $entityManager->remove($autoRequest);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_auto_request_index', [], Response::HTTP_SEE_OTHER);
    }
}
