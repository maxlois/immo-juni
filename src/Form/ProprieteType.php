<?php

namespace App\Form;

use App\Entity\Propriete;
use App\Entity\Quartier;
use App\Entity\TypePropriete;
use App\Entity\User;
use App\Repository\QuartierRepository;
use App\Repository\TypeProprieteRepository;
use App\Repository\UserRepository;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Doctrine\ORM\QueryBuilder;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProprieteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomPro', TextType::class,[
                'attr' => [
                    'class' => "form-control"
                ], 
                'label' => "Nom Propriété"
            ])
            ->add('superficie', TextType::class,[
                'attr' => [
                    'class' => "form-control"
                ], 
                'label' => "Superficie"
            ])
            ->add('statut', TextType::class,[
                'attr' => [
                    'class' => "form-control"
                ], 
                'label' => "Statut"
            ])
            ->add('longeur', TextType::class,[
                'attr' => [
                    'class' => "form-control"
                ], 
                'label' => "Longeur"
            ])
            ->add('largeur', TextType::class,[
                'attr' => [
                    'class' => "form-control"
                ], 
                'label' => "Largeur"
            ])
            ->add('hauteur', TextType::class,[
                'attr' => [
                    'class' => "form-control"
                ], 
                'label' => "Hauteur"
            ])
            ->add('photo')
            ->add('photo2')
            ->add('photo3')
            ->add('photo4')
            ->add('photo5')
            ->add('prixPro', TextType::class,[
                'attr' => [
                    'class' => "form-control"
                ], 
                'label' => "Prix"
            ])
            ->add('proprietaire',EntityType::class,[
                'class' => User::class,
                'query_builder' => function (UserRepository $er): QueryBuilder {
                    return $er->createQueryBuilder('i')
                        ->orderBy('i.nom ', 'ASC');
                },
                'attr' => [
                    'class' => "form-control"
                ],
            ])
            ->add('gestionnaire',EntityType::class,[
                'class' => User::class,
                'query_builder' => function (UserRepository $er): QueryBuilder {
                    return $er->createQueryBuilder('i')
                        ->orderBy('i.nom ', 'ASC');
                },
                'attr' => [
                    'class' => "form-control"
                ],
            ])
            ->add('quartier',EntityType::class,[
                'class' => Quartier::class,
                'query_builder' => function (QuartierRepository $er): QueryBuilder {
                    return $er->createQueryBuilder('i')
                        ->orderBy('i.nomQuartier ', 'ASC');
                },
                'attr' => [
                    'class' => "form-control"
                ],

                'choice_label' => 'nomQuartier ',
            
                ])
            ->add('typePropriete',EntityType::class,[
                'class' => TypePropriete::class,
                'query_builder' => function (TypeProprieteRepository $er): QueryBuilder {
                    return $er->createQueryBuilder('i')
                        ->orderBy('i.typeBase ', 'ASC');
                },
                'attr' => [
                    'class' => "form-control"
                ],

                'choice_label' => 'typeBase ',
            
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Propriete::class,
        ]);
    }
}
