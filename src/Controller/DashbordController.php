<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Repository\ImageRepository;
use App\Repository\HoraireRepository;
class DashbordController extends AbstractController
{
    #[Route('/admin', name: 'app_dashbord')]

    
    public function index(ImageRepository $image,HoraireRepository $horaire, HoraireRepository $horaires): Response
    {

        $image= $image->findAll();
        $count=count($image);
     
        return $this->render('dashbord/index.html.twig', [
            'controller_name' => 'DashbordController',
      
            'count'=>$count,
            'horaire'=>$horaires->findAll(),
            'horairedujour'=>$horaire->findAll(),
        ]);
    }
}
