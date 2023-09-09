<?php

namespace App\Form;
use App\Entity\Location;
use App\Entity\Propriete;
use App\Entity\User;
use App\Repository\ProprieteRepository;
use App\Repository\UserRepository;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Doctrine\ORM\QueryBuilder;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LocationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $year = date('Y') ;
        $listYears = [] ;

        for($i = $year; $i > ($year-2) ; $i--){
            $listYears[$i] = [$i] ;
        }

        $builder
            ->add('dateD_location', DateType::class,[
                'attr'=> [
                    'class'=>"form-control"
                ], 
                'label' => "Date de Location",
                'widget' => 'single_text',
            ])
            ->add('penalite', IntegerType::class,[
                'attr' => [
                    'class' => "form-control",
                ], 
                'label' => "Pénalité (%)",
                'required' => false
            ])
            ->add('delaisPaiem', IntegerType::class,[
                'attr'=> [
                    'class'=>"form-control",
                    'min'=> 1
                ],
                    'label' => "Délai de paiement"
               
            ])

            ->add('mois', ChoiceType::class,[
              'attr'=>[
                'class'=>"form-control"
              ],
              'label' => "Mois de départ de la location",
              'choices' => [
                'Janvier' => '01',
                'Février' => '02',
                'Mars' => '03'
              ]

            ])

            ->add('annee', ChoiceType::class, [
                'attr'=>[
                  'class'=>'form-control'
                ],
                'label'=>'Année de la location',
                'choices' => [
                    2023 => 2023,
                    2022 => 2022
                ]
            ])

            ->add('modePaiem', ChoiceType::class, [
                'attr'=>[
                  'class'=>'form-control'
                ],
                'mapped' => false,
                'label'=>'Mode de paiement',
                'choices' => [
                    "Orange Money" => "Orange Money",
                    "Espèces" => "Espèces",
                ]
            ])
            ->add('moisAvance', IntegerType::class,[
                'attr'=>[
                    'class'=>'form-control',
                    'min' => 1
                ],
                'label'=>"Nombre de mois d'avance",
                'required' => true
            ])
            ->add('causionEnt', null ,[
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => "Caution d'entrée"
            ])
          
            ->add('etatLieu',FileType::class, [
                'label' => 'Etat des lieu',
                'mapped' => false,
                'required' => $options['attrRequired'],
                'attr' => [
                    'class' => 'form-control'
                    ]
            ] )
            ->add('propriete', EntityType::class,[
                'class' => Propriete::class,
                'query_builder' => function (ProprieteRepository $er): QueryBuilder {
                    return $er->createQueryBuilder('i')
                        ->orderBy('i.nomPro ', 'ASC');
                },
                'attr' => [
                    'class' => "form-control"
                ],

                'choice_label' => 'nomPro ',
            
                ])
            ->add('locataire',EntityType::class,[
                'class' => User::class,
                'query_builder' => function (UserRepository $er): QueryBuilder {
                    return $er->createQueryBuilder('i')
                        ->orderBy('i.nom ', 'ASC');
                },
                'attr' => [
                    'class' => "form-control"
                ],
                'label' => "Locataire"
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Location::class,
            'attrRequired' => true
        ]);
    }
}
