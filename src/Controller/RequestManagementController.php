<?php

namespace App\Controller;

use App\Entity\RequestManagement;
use App\Form\RequestManagementType;
use App\Repository\RequestManagementRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\HoraireRepository;

#[Route('/demand')]
class RequestManagementController extends AbstractController
{
    #[Route('/admin', name: 'app_request_management_index', methods: ['GET'])]
    public function index(RequestManagementRepository $requestManagementRepository, HoraireRepository $horaire): Response
    {
        return $this->render('request_management/index.html.twig', [
            'request_managements' => $requestManagementRepository->findAll(),
            'horairedujour'=>$horaire->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_request_management_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, HoraireRepository $horaire): Response
    {
        $requestManagement = new RequestManagement();
        $form = $this->createForm(RequestManagementType::class, $requestManagement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($requestManagement);
            $entityManager->flush();
            $this->addFlash('Succès', 'Votre demande à bien été envoyée');

            return $this->redirectToRoute('app_request_management_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('request_management/new.html.twig', [
            'request_management' => $requestManagement,
            'form' => $form,
            'horairedujour'=>$horaire->findAll(),
        ]);
    }

    #[Route('/{id}', name: 'app_request_management_show', methods: ['GET'])]
    public function show(RequestManagement $requestManagement, HoraireRepository $horaire): Response
    {
        return $this->render('request_management/show.html.twig', [
            'request_management' => $requestManagement,
            'horairedujour'=>$horaire->findAll(),
        ]);
    }

    #[Route('/{id}/edit', name: 'app_request_management_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, RequestManagement $requestManagement, EntityManagerInterface $entityManager, HoraireRepository $horaire): Response
    {
        $form = $this->createForm(RequestManagement1Type::class, $requestManagement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_request_management_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('request_management/edit.html.twig', [
            'request_management' => $requestManagement,
            'form' => $form,
            'horairedujour'=>$horaire->findAll()
        ]);
    }

    #[Route('/{id}', name: 'app_request_management_delete', methods: ['POST'])]
    public function delete(Request $request, RequestManagement $requestManagement, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$requestManagement->getId(), $request->request->get('_token'))) {
            $entityManager->remove($requestManagement);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_request_management_index', [], Response::HTTP_SEE_OTHER);
    }
}
