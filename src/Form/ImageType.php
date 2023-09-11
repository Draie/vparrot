<?php

namespace App\Form;

use App\Entity\Image;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class ImageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('created_at')
            ->add('price')
            ->add('kms')
            ->add('equipement')
            ->add('Nbplaces')
            ->add('carburant')
            ->add('photo', FileType::class, [
                'label' => 'Image de couverture (image file)',

                // unmapped means that this field is not associated to any entity property
                'mapped' => true,

                // make it optional so you don't have to re-upload the PDF file
                // every time you edit the Product details
                'required' => false,

                // unmapped fields can't define their validation using annotations
                // in the associated entity, so you can use the PHP constraint classes
                'constraints' => [
                    new File([
                        'maxSize' => '5000k',
                        'extensions' => [
                            'jpg','png','jpeg'
                        ],
                        'mimeTypesMessage' => 'Please upload a valid photo document',
                    ])
                ],
            ])


            ->add('photo2', FileType::class, [
                'label' => 'Image n°2 (image file)',

                // unmapped means that this field is not associated to any entity property
                'mapped' => true,

                // make it optional so you don't have to re-upload the PDF file
                // every time you edit the Product details
                'required' => false,

                // unmapped fields can't define their validation using annotations
                // in the associated entity, so you can use the PHP constraint classes
                'constraints' => [
                    new File([
                        'maxSize' => '5000k',
                        'extensions' => [
                            'jpg','png','jpeg'
                        ],
                        'mimeTypesMessage' => 'Please upload a valid photo document',
                    ])
                ],
            ])



            ->add('photo3', FileType::class, [
                'label' => 'Image n°3 (image file)',

                // unmapped means that this field is not associated to any entity property
                'mapped' => true,

                // make it optional so you don't have to re-upload the PDF file
                // every time you edit the Product details
                'required' => false,

                // unmapped fields can't define their validation using annotations
                // in the associated entity, so you can use the PHP constraint classes
                'constraints' => [
                    new File([
                        'maxSize' => '5000k',
                        'extensions' => [
                            'jpg','png','jpeg'
                        ],
                        'mimeTypesMessage' => 'Please upload a valid photo document',
                    ])
                ],
            ])
           /* ->get('photo')->addModelTransformer(new CallbackTransformer(
                function($photo) {
                    return null;
                },
                function($photo) {
                    return $photo;
                }
            ))

                */
       
        ;
  

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Image::class,
        ]);
    }
}
