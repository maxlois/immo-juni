<?php

namespace App\Form;

use App\Entity\Quartier;
use App\Entity\Ville;
use App\Repository\VilleRepository;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Doctrine\ORM\QueryBuilder;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class QuartierType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomQuartier', TextType::class,[
                'attr' => [
                    'class' => "form-control"
                ], 
                'label' => "Nom du quartier"
            ])
            ->add('numRue', TextType::class,[
                'attr' => [
                    'class' => "form-control"
                ], 
                'label' => "Numero Rue"
            ])
            ->add('codePost', TextareaType::class,[
                'attr' => [
                    'class' => "form-control"
                ], 
                'label' => "Code Postal"
            ])
            ->add('localQ', TextType::class,[
                'attr' => [
                    'class' => "form-control"
                ], 
                'label' => "Localisation"
            ])
            ->add('ville',EntityType::class,[
                'class' => Ville::class,
                'query_builder' => function (VilleRepository $er): QueryBuilder {
                    return $er->createQueryBuilder('i')
                        ->orderBy('i.nomV ', 'ASC');
                },
                'attr' => [
                    'class' => "form-control"
                ],

                'choice_label' => 'nomV ',
            
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Quartier::class,
        ]);
    }
}
