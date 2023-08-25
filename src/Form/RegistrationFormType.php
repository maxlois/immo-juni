<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class,[
                'attr'=>[
                    'class'=>"form-control"
                ]
            ])
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
                'input'  => 'datetime_immutable',
                'label'=>"Date de Naissance",
                'days' => range(1,31)
            ])
            ->add('tel', NumberType::class,[
                'attr'=> [
                    'class'=>"form-control"
                ],
                'label'=>"Numéro de téléphone"
            ])
            ->add('adress', TextType::class,[
                'attr'=> [
                    'class'=>"form-control"
                ],
                'label'=>"Adresse"
            ])
            ->add('genre', ChoiceType::class, [
                'choices'  => [
                    'feminin' => "Femini",
                    'masculin' => "Masculin",
                    ],'attr' => [
                    'class' => "form-control"
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


            // ->add('actCompt' , ChoiceType::class, [
            //     'choices'  => [
            //         'oui' => "Oui",
            //         'non' => "Non",
            //         ],'attr' => [
            //         'class' => "form-control"
            //     ], 
            //     ])

            //     ->add('verifComp', ChoiceType::class, [
            //         'choices'  => [
            //             'active' => "Activé",
            //             'desactive' => "Desactivé",
            //             ],'attr' => [
            //             'class' => "form-control"
            //         ], 
            //         ])

                ->add('roles', ChoiceType::class, [
                   'choices'  => [
                       'proprietaire' => "ROLE_PROPRIETAIRE",
                      'gestionaire' => "ROLE_GESTIONNAIRE",
                       'administrateur' => "ROLE_SUPER_ADMIN ",
                        ],
                        'attr' => [
                            'class' => "form-control"
                            ], 
                   //'multiple'=> true,
                    'label'=>"Rôle"
                ])


                ->add('plainPassword', PasswordType::class, [
                    // instead of being set onto the object directly,
                    // this is read and encoded in the controller
                    'mapped' => false,
                    'attr' => ['autocomplete' => 'new-password'],
                    'attr' => [
                        'class' => 'form-control'
                    ],
                    'constraints' => [
                        new NotBlank([
                            'message' => 'Please enter a password',
                        ]),
                        new Length([
                            'min' => 6,
                            'minMessage' => 'Your password should be at least {{ limit }} characters',
                            // max length allowed by Symfony for security reasons
                            'max' => 4096,
                        ]),
                    ],
                    
                ])

            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'You should agree to our terms.',
                    ]),
                ],
                'label' => "J'accepte tout"
            ]);
          
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
