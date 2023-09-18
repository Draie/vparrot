<?php

namespace App\Form;

use App\Entity\AutoRequest;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AutoRequestType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('autoName', TextType::class,[
                'label'=>'Annonce',
                'required'=>false,

            ])
            ->add('nom', TextType::class,[
                'label'=>'Nom',
                'required'=>true,
            ])
            ->add('prenom', TextType::class,[
                'label'=>'Prénom',
                'required'=>true,
            ])
            ->add('mail', EmailType::class,[
                'label'=>'Adresse mail',
                'required'=>true
            ])
            ->add('phoneNumber', NumberType::class,[
                'label'=>'Numéro de téléphone',
                'required'=>true ,
            ])
      
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => AutoRequest::class,
        ]);
    }
}
