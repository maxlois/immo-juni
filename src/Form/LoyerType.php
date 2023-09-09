<?php

namespace App\Form;

use App\Entity\Location;
use App\Entity\Loyer;
use App\Repository\LocationRepository;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Doctrine\ORM\QueryBuilder;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LoyerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('prixLoyer', TextType::class,[
                'attr' => [
                   'class'=>'form-control'
                ],
                    'label' => "Prix du Loyer"
            ] )
            ->add('dateLoyer', DateType::class,[
                'attr'=>[
                  'class'=>'form-control'
                ],
                'label'=> 'Date de Loyer'
            ])
            ->add('typePaie',ChoiceType::class, [
                'choices'  => [
                    'Impayé' => 0,
                    'Payement partiel' => 1 ,
                    'Payement total' => 2
                ],
                'attr'=>[
                    'class'=>'form-control'
                ],
                'label'=>'Type de Paiement'
                ])
            // ->add('statutLoy', ChoiceType::class, [
            //     'choices'  => [
            //       'yes' => true,
            //       'no' => false,
            //        ],'attr' => [
            //       'class' => "form-control"
            //   ],
            //   'label'=>'Statut du Loyer'
            //   ])
            ->add('MontLoy',TextType::class,[
                'attr' => [
                   'class'=>'form-control'
                ],
                    'label' => "Montant Payé"
            ])
            ->add('appliPenal', ChoiceType::class, [
                'choices'  => [
                  'yes' => true,
                  'no' => false,
                   ],'attr' => [
                  'class' => "form-control"
              ],
              'label'=>'Pénalité'
              ])
            ->add('mois',ChoiceType::class, [
                'choices'  => [
                    'Janvier' => "Janvier",
                    'Février' => "Février",
                    'Mars' => "Mars",
                    'Avril' => "Avril",
                    'Mai' => "Mai",
                    'juin' => "juin",
                    'Juillet' => "Juillet",
                    'Août' => "Août",
                    'Spetembre' => "Spetembre",
                    'Octobre' => "Octobre",
                    'Novembre' => "Novembre",
                    'Décembre' => "Décembre",
                ],
                'attr' => [
                    'class' => "form-control"
                ], 
            ])
            ->add('annee', NumberType::class, [
                'label' => 'Année',
                'attr' => [
                    'class'=>'form-control',
                    'min' => 1900, // Année minimale
                    'max' => 2100, // Année maximale
                ],
            ])
            ->add('modePaie',ChoiceType::class, [
                'choices'  => [
                    'MoovMoney' => "MoovMoney",
                    'OrangeMoney' => "OrangeMoney",
                    'MTNMoney' => "MTNMoney"
                ],
                'attr'=>[
                    'class'=>'form-control'
                ],
                'label'=>'Type de Paiement'
            ])
            ->add('refPaie',TextType::class,[
                'attr'=>[
                    'class'=>'form-control'
                ],
                'label'=>'Reférence paiement'
            ])
            ->add('montPaie',TextType::class,[
                'attr'=>[
                    'class'=>'form-control'
                ],
                'label'=>'Montant Restant'
            ])
            ->add('location',EntityType::class ,[
                'class' => Location::class,
                'query_builder' => function (LocationRepository $er): QueryBuilder {
                    return $er->createQueryBuilder('i')
                        ->orderBy('i.causionEnt', 'ASC');
                },
                'attr' => [
                    'class' => "form-control"
                ],

                'choice_label' => 'causionEnt ',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Loyer::class,
        ]);
    }
}
