<?php

namespace App\Form;

use App\Entity\TypePropriete;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TypeProType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

            ->add('nomTyPro', ChoiceType::class,[
                'choices' =>[
                    'villa' => 'Villa',
                    'immeuble' => 'Immeuble',
                ],
                'attr' =>[
                    'class'=>'form-control'
                ], 
                'label' => "Nom du type de Propriete"
            ])
            ->add('nombPiece', TextType::class,[
                'attr' => [
                    'class' => "form-control"
                ], 
                'label' => "Nombre de pièce"
            ])

           
            ->add('typeBase', ChoiceType::class, [
                'choices'  => [
                    'base' => null,
                    'Yes' => true,
                    'No' => false,
                    ],'attr' => [
                    'class' => "form-control"
                ], 
                ])
            ->add('descTyp', TextareaType::class,[
                'attr' => [
                    'class' => "form-control"
                ], 
                'label' => "Description"
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => TypePropriete::class,
        ]);
    }
}
