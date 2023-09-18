<?php

namespace App\Form;

use App\Entity\RequestManagement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints\NotBlank;

class RequestManagementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('object')
            ->add('Nom', TextType::class,[
                'required'=>true
            ])
            ->add('Prenom', TextType::class,[
            'required'=>true,
            'label'=>'Prenom'
            ])
            ->add('mail',EmailType::class,[
                'required'=>'true',
                'label'=>'Adresse e-mail'
            ])
            ->add('phoneNumber', NumberType::class,[
                'required'=>true,
                'label'=>'Téléphone'
            ])
            ->add('RequestObject', TextareaType::class, [
                'label'=>'Message'
            ])
            
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => RequestManagement::class,
        ]);
    }
}
