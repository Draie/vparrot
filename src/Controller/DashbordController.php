<?php

namespace App\Controller;

use App\Repository\ServiceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Repository\ImageRepository;
use App\Repository\HoraireRepository;
class DashbordController extends AbstractController
{
    #[Route('/admin', name: 'app_dashbord')]

    
    public function index(ImageRepository $imageRepository,HoraireRepository $horaire, HoraireRepository $horaires,ServiceRepository $serviceRepository ): Response
    {

        $imageRepository= $imageRepository->findAll();
        $count=count($imageRepository);
     
        return $this->render('dashbord/index.html.twig', [
            'controller_name' => 'DashbordController',
            'count'=>$count,
            'horaire'=>$horaires->findAll(),
            'horairedujour'=>$horaire->findAll(),
            'service'=>$serviceRepository->findAll(),
          
        ]);
    }
}
