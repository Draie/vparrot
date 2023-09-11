<?php

namespace App\Form;

use App\Entity\Image;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;

class ImageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom',TextType::class, [
                'required'   => true,
                'label' => 'Modèle'
            ])
            ->add('created_at', DateType::class, [
                'widget' => 'choice',
                'label' => 'Date de mise en circulation',
                'input'  => 'datetime_immutable'
            
            ])
            ->add('price', MoneyType::class, [
                'divisor' => 100,
                'label'=>'Prix'
            ])
            ->add('kms')
            ->add('equipement',TextareaType::class, [
                'required'   => true,
                'label' => 'Equipement'
            ])
            ->add('Nbplaces')
            ->add('carburant',TextType::class,[
                'required'=>true,
            ] )
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
