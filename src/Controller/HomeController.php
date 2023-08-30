<?php

namespace App\Controller;

use App\Repository\HoraireRepository;
use App\Repository\ServiceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(ServiceRepository $repo, HoraireRepository $horaire): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'service'=>$repo->findAll(),
            'horairedujour'=>$horaire->findAll(),
        ]);
    }
}
