<?php

namespace App\Controller;

use App\Entity\Image;
use App\Form\ImageTypeEdit;
use App\Form\ImageType;
use App\Repository\ImageRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\String\Slugger\SluggerInterface;

#[Route('/imggest')]
class ImageGestController extends AbstractController
{
    #[Route('/', name: 'app_image_gest_index', methods: ['GET'])]
    public function index(ImageRepository $imageRepository): Response
    {
        return $this->render('image_gest/index.html.twig', [
            'images' => $imageRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_image_gest_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, SluggerInterface $slugger): Response
    {
        $image = new Image();
        $form = $this->createForm(ImageType::class, $image);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($image);
            $entityManager->flush();

            if ($form->isSubmitted() && $form->isValid()) {
                /** @var UploadedFile $photoFile */
                $photoFile = $form->get('photo')->getData();
    
                // this condition is needed because the 'brochure' field is not required
                // so the PDF file must be processed only when a file is uploaded
                if ($photoFile) {
                    $originalFilename = pathinfo($photoFile->getClientOriginalName(), PATHINFO_FILENAME);
                    // this is needed to safely include the file name as part of the URL
                    $safeFilename = $slugger->slug($originalFilename);
                    $newFilename = $safeFilename.'-'.uniqid().'.'.$photoFile->guessExtension();
                    $image->setPhoto($newFilename);
                    $entityManager->flush();
                    // Move the file to the directory where brochures are stored
                    try {
                        $photoFile->move(
                            $this->getParameter('photo_directory'),
                            $newFilename
                        );
                    } catch (FileException $e) {
                        // ... handle exception if something happens during file upload
                    }
    
                    // updates the 'brochureFilename' property to store the PDF file name
                    // instead of its contents
                    $image->setPhoto($newFilename);
                }
    
                // ... persist the $product variable or any other work
            }    
            return $this->redirectToRoute('app_image_gest_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('image_gest/new.html.twig', [
            'image' => $image,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_image_gest_show', methods: ['GET'])]
    public function show(Image $image): Response
    {
        return $this->render('image_gest/show.html.twig', [
            'image' => $image,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_image_gest_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Image $image, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ImageTypeEdit::class, $image);
        $form->handleRequest($request);
        


            


        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_image_gest_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('image_gest/edit.html.twig', [
            'image' => $image,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_image_gest_delete', methods: ['POST'])]
    public function delete(Request $request, Image $image, EntityManagerInterface $entityManager): Response
    {
        
        
           


        if ($this->isCsrfTokenValid('delete'.$image->getId(), $request->request->get('_token'))) {
            $entityManager->remove($image);
            $todelete=$image->getPhoto();
            $entityManager->flush();

            if ($todelete ){
                $path=$this->getParameter("photo_directory").'/'.$todelete;
    
                // verfier que limage existe //
               
                        unlink($path);
                
            
            }
         ;
            
        }

        return $this->redirectToRoute('app_image_gest_index', [], Response::HTTP_SEE_OTHER);
    }
}
