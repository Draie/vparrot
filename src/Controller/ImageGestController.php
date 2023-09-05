<?php

namespace App\Controller;

use App\Entity\Image;
use App\Form\ImageTypeEdit;
use App\Form\ImageType;
use App\Repository\ImageRepository;
use App\Repository\HoraireRepository;
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
    public function index(ImageRepository $imageRepository, HoraireRepository $horaire): Response
    {
        return $this->render('image_gest/index.html.twig', [
            'images' => $imageRepository->findAll(),
            'horairedujour'=>$horaire->findAll()
        ]);
    }


    #[Route('/auto', name: 'app_image_gest_auto', methods: ['GET', 'POST'])]
    public function auto( HoraireRepository $horaire,ImageRepository $photo): Response
    {
        return $this->render('image_gest/autoCard.html.twig', [
            'image'=> $photo->findAll(),
            'horairedujour'=>$horaire->findAll()
        ]);
    }

    #[Route('/{id}', name: 'app_image_gest_autoShow', methods: ['GET'])]
    public function autoshow(Image $image, HoraireRepository $horaire): Response
    {
        return $this->render('image_gest/autoShow.html.twig', [
            'image' => $image,
            'horairedujour'=>$horaire->findAll()
        ]);
    }

    #[Route('/new', name: 'app_image_gest_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, SluggerInterface $slugger, HoraireRepository $horaire): Response
    {
        $image = new Image();
        $form = $this->createForm(ImageType::class, $image);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($image);
            $entityManager->flush();

            if ($form->isSubmitted() && $form->isValid()) {
                /** @var UploadedFile $photoFile */
                /** @var UploadedFile $photoFile2 */
                /** @var UploadedFile $photoFile3 */
                $photoFile = $form->get('photo')->getData();
                $photoFile2 = $form->get('photo2')->getData();
                $photoFile3 = $form->get('photo3')->getData();
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


                //TRAITEMENT PHOTO 2 //
                if ($photoFile2) {
                    $originalFilename2 = pathinfo($photoFile2->getClientOriginalName(), PATHINFO_FILENAME);
                    // this is needed to safely include the file name as part of the URL
                    $safeFilename2 = $slugger->slug($originalFilename2);
                    $newFilename2 = $safeFilename2.'-'.uniqid().'.'.$photoFile2->guessExtension();
                    $image->setPhoto2($newFilename2);
                    $entityManager->flush();
                    // Move the file to the directory where brochures are stored
                    try {
                        $photoFile2->move(
                            $this->getParameter('photo_directory'),
                            $newFilename2
                        );

                        
                    } catch (FileException $e) {
                        // ... handle exception if something happens during file upload
                    }
    
                    // updates the 'brochureFilename' property to store the PDF file name
                    // instead of its contents
                    $image->setPhoto2($newFilename2);
                }
                    //TRAITEMENT PHOTO 3 //
                if ($photoFile3) {
                    $originalFilename3 = pathinfo($photoFile3->getClientOriginalName(), PATHINFO_FILENAME);
                    // this is needed to safely include the file name as part of the URL
                    $safeFilename3 = $slugger->slug($originalFilename3);
                    $newFilename3 = $safeFilename3.'-'.uniqid().'.'.$photoFile3->guessExtension();
                    $image->setPhoto3($newFilename3);
                    $entityManager->flush();
                    // Move the file to the directory where brochures are stored
                    try {
                        $photoFile3->move(
                            $this->getParameter('photo_directory'),
                            $newFilename3
                        );
                    } catch (FileException $e) {
                        // ... handle exception if something happens during file upload
                    }
    
                    // updates the 'brochureFilename' property to store the PDF file name
                    // instead of its contents
                    $image->setPhoto3($newFilename3);
                }
    
                // ... persist the $product variable or any other work
            }    
            return $this->redirectToRoute('app_image_gest_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('image_gest/new.html.twig', [
            'image' => $image,
            'form' => $form,
            'horairedujour'=>$horaire->findAll()
        ]);
    }

    #[Route('/{id}', name: 'app_image_gest_show', methods: ['GET'])]
    public function show(Image $image, HoraireRepository $horaire): Response
    {
        return $this->render('image_gest/show.html.twig', [
            'image' => $image,
            'horairedujour'=>$horaire->findAll()
        ]);
    }

   
   
   
    #[Route('/{id}/edit', name: 'app_image_gest_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Image $image, EntityManagerInterface $entityManager, HoraireRepository $horaire): Response
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
            'horairedujour'=>$horaire->findAll()
        ]);
    }
    

    #[Route('/{id}', name: 'app_image_gest_delete', methods: ['POST'])]
    public function delete(Request $request, Image $image, EntityManagerInterface $entityManager, HoraireRepository $horaire): Response
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
