<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email',EmailType::class, [
                'attr'=> [
                    'class' => "form-control"
                ],
                'label'=>"E-Mail"
            ])

             ->add('adress', TextType::class,[
                'attr'=>[
                    'class'=>'form-control'
                ],

                'label'=>"Adresse"
             ])
            ->add('roles', ChoiceType::class, [
                    'choices'  => [
                        'proprietaire' => "ROLE_PROPRIETAIRE",
                        'gestionaire' => "ROLE_GESTIONNAIRE",
                        'locataire' => "ROLE_LOCATAIRE",
                        'administrateur' => "ROLE_SUPER_ADMIN ",
                    ],
                    'attr' => [
                        'class' => "form-control"
                    ], 
                    //'multiple'=> true,
                    'label'=>"Rôle"
                ])

            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'first_options' => [
                    'attr' => [
                        'class' => 'form-control'
                    ],
                    'label' => 'Mot de passe',
                    'label_attr' => [
                        'class' => 'form-label'
                    ]
                ],
                'second_options' => [
                    'attr' => [
                        'class' => 'form-control'
                    ],
                    'label' => 'Confirmation du mot de passe',
                    'label_attr' => [
                        'class' => 'form-label  mt-4'
                    ]
                ],
                'invalid_message' => 'Les mots de passe ne correspondent pas.'
            ]
            )
            ->add('nom', TextType::class, [
                'attr'=> [
                    'class' => "form-control"
                ],
                'label'=>"Nom"
            ])
            ->add('prenom', TextType::class, [
                'attr'=> [
                    'class' => "form-control"
                ],
                'label'=>"Prenom"
            ])
            ->add('dateNais', DateType::class,[
                    'widget' => 'choice',
                    'input'  => 'datetime_immutable'
               
            ])
            ->add('tel', NumberType::class,[
                'attr'=> [
                    'class'=>"form-control"
                ],
                'label'=>"Numéro de téléphone"
            ])
            ->add('genre', ChoiceType::class, [
                'choices' => [
                    'Feminin' => 1,
                    'Masculin' => 2,
                ],
                'choice_attr' => [
                    'Feminin' => [ 'Feminin'],
                    'Masculin' => ['Masculin'],
                ],

                ])
            ->add('nationalite', TextType::class,[
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => "Nationnalié"
            ])
            ->add('profession', TextType::class,[
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => "Profession"
            ])
            ->add('tyPiece', TextType::class,[
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => "Type de pièce"
            ])
            ->add('numPiece', TextType::class,[
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => "Numéro de pièce"
            ])

            ->add('actCompte' , ChoiceType::class, [
                'choices'  => [
                    'oui' => "Oui",
                    'non' => "Non",
                    ],'attr' => [
                    'class' => "form-control"
                ], 
                ])
                
            ->add('verifCompte', ChoiceType::class, [
                'choices'  => [
                    'active' => "Activé",
                    'desactive' => "Desactivé",
                    ],'attr' => [
                    'class' => "form-control"
                ], 
                ])
        ;

        $builder->get('roles')
        ->addModelTransformer(new CallbackTransformer(function($arrayRoles){
            return count($arrayRoles) ? $arrayRoles[0] : null;
        },
        function($rolesString){
            return[$rolesString];
        }
    ));
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }

  
}
