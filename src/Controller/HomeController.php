<?php

namespace App\Controller;

use App\Repository\FeedbackRepository;
use App\Repository\HoraireRepository;
use App\Repository\ServiceRepository;
use App\Repository\ImageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(ServiceRepository $repo, HoraireRepository $horaire,ImageRepository $photo, FeedbackRepository $feed): Response
    {
        
        return $this->render('home/index.html.twig', [
            'service'=>$repo->findAll(),
            'horairedujour'=>$horaire->findAll(),
            'image'=> $photo->findAll(),
            'feed'=>$feed->findAll(),
        ]);
    }


    #[Route('/auto', name: 'app_auto')]
    public function auto(ServiceRepository $repo, HoraireRepository $horaire,ImageRepository $photo ): Response
    {
        return $this->render('home/vehicule.html.twig', [
            'image'=> $photo->findAll(),
            'horairedujour'=>$horaire->findAll(),
        ]);
    }



    #[Route('/test', name: 'app_test')]
public function test(ServiceRepository $repo, HoraireRepository $horaire,ImageRepository $photo ): Response
{
    return $this->render('dashbord/adminSide_bar.html.twig', [
        'image'=> $photo->findAll(),
        'horairedujour'=>$horaire->findAll(),
    ]);
}
}


