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
use Symfony\Component\Validator\Constraints\File;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Choice;

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
            ->add('statut', ChoiceType::class,[
                'choices' => [
                    'yes' => true,
                    'no'=> false,
                ], 
                'attr'=>[
                    'class'=>'form-control'
                ],
                'label' => "Statut"
            ])
            ->add('longeur', TextType::class,[
                'attr' => [
                    'class' => "form-control"
                ], 
                'label' => "Longeur (m)"
            ])
            ->add('largeur', TextType::class,[
                'attr' => [
                    'class' => "form-control"
                ], 
                'label' => "Largeur (m)"
            ])
            ->add('hauteur', TextType::class,[
                'attr' => [
                    'class' => "form-control"
                ], 
                'label' => "Hauteur (m)"
            ])
            ->add('image', FileType::class, [
                'label' => 'Image principale',
                'mapped' => false,
                'required' => $options['attrRequired'],
                'attr' => [
                    'accept' => 'image/*',
                    'class' => 'form-control'
                ],
                'constraints' => [
                    new File([
                            'maxSize' => '10240k',
                            /*'mimeTypes' => [
                                'image/*',
                            ],*/
                            'mimeTypesMessage' => 'Votre fichier doit être obligatoirement une image !',
                        ])
                    ]
            ])
            ->add('image2', FileType::class, [
                'label' => 'Image 2',
                'mapped' => false,
                'required' => $options['attrRequired'],
                'attr' => [
                    'accept' => 'image/*',
                    'class' => 'form-control'
                ],
                'constraints' => [
                    new File([
                            'maxSize' => '10240k',
                            /*'mimeTypes' => [
                                'image/*',
                            ],*/
                            'mimeTypesMessage' => 'Votre fichier doit être obligatoirement une image !',
                        ])
                    ]
            ])
            ->add('image3', FileType::class, [
                'label' => 'Image 3',
                'mapped' => false,
                'required' => $options['attrRequired'],
                'attr' => [
                    'accept' => 'image/*',
                    'class' => 'form-control'
                ],
                'constraints' => [
                    new File([
                            'maxSize' => '10240k',
                            /*'mimeTypes' => [
                                'image/*',
                            ],*/
                            'mimeTypesMessage' => 'Votre fichier doit être obligatoirement une image !',
                        ])
                    ]
            ])
            ->add('image4', FileType::class, [
                'label' => 'Image 4',
                'mapped' => false,
                'required' => $options['attrRequired'],
                'attr' => [
                    'accept' => 'image/*',
                    'class' => 'form-control'
                ],
                'constraints' => [
                    new File([
                            'maxSize' => '10240k',
                            /*'mimeTypes' => [
                                'image/*',
                            ],*/
                            'mimeTypesMessage' => 'Votre fichier doit être obligatoirement une image !',
                        ])
                    ]
            ])
            ->add('image5', FileType::class, [
                'label' => 'Image 5',
                'mapped' => false,
                'required' => $options['attrRequired'],
                'attr' => [
                    'accept' => 'image/*',
                    'class' => 'form-control'
                ],
                'constraints' => [
                    new File([
                            'maxSize' => '10240k',
                            /*'mimeTypes' => [
                                'image/*',
                            ],*/
                            'mimeTypesMessage' => 'Votre fichier doit être obligatoirement une image !',
                        ])
                    ]
            ])
            ->add('prixPro', TextType::class,[
                'attr' => [
                    'class' => "form-control"
                ], 
                'label' => "Prix. cfa"
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
                'label' => "Gestionnaire"
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
                'label' => 'Quartier ',
            
                ])
            ->add('typePropriete',EntityType::class,[
                'class' => TypePropriete::class,
                'query_builder' => function (TypeProprieteRepository $er): QueryBuilder {
                    return $er->createQueryBuilder('i')
                        ->orderBy('i.nomTyPro ', 'ASC');
                },
                'attr' => [
                    'class' => "form-control"
                ],

                'choice_label' => 'nomTyPro ',
                'label' => "Type propriete"
            
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Propriete::class,
            'attrRequired' => true
        ]);
    }
}
