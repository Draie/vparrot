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
    public function index(ImageRepository $image,HoraireRepository $horairedujour ): Response
    {
        return $this->render('dashbord/index.html.twig', [
            'controller_name' => 'DashbordController',
            'image'=>$image->count([$image]),
            'horairedujour'=>$horairedujour
        ]);
    }
}
