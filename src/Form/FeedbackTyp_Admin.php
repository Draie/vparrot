<?php

namespace App\Form;

use App\Entity\Feedback;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\RangeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class FeedbackType_Admin extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('pseudo', TextType::class,[
                'label'=> 'Nom / Surnom',
                'required'=>true,
            ])
            ->add('comment', TextareaType::class,[
                'label'=> 'Commentaire',
                'required'=>true,
            ])
            ->add('note', RangeType::class,[
                'label'=>'Niveaux de satisfaction',
                'attr' => [
                    'min' => 1,
                    'max' => 5
                ],
            ])

            ->add('status', CheckboxType::class,[
                'label'=> 'Validé',
                'required'=>false,
            ])
  
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Feedback::class,
        ]);
    }
}
