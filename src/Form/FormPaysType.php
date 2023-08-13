<?php

namespace App\Form;

use App\Entity\Pays;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FormPaysType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomP', TextType::class,[
                'attr' => [
                    'class' => "form-control"
                ], 
                'label' => "Nom"
            ])
            ->add('langue' , TextType::class,[
                'attr' => [
                    'class' => "form-control"
                ], 
            ])
            ->add('identifTel', TextType::class,[
                'attr' => [
                    'class' => "form-control"
                ], 
                'label' => "Identifient téléphonique"
            ])
            ->add('codeIso', TextType::class,[
                'attr' => [
                    'class' => "form-control"
                ], 
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Pays::class,
        ]);
    }
}
