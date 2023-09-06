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
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LocationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('dateD_location', DateType::class,[
                'attr'=> [
                    'class'=>"form-control"
                ],
                    'widget' => 'choice',
                    'input'  => 'datetime_immutable',
                    'label' => "Date de Location"
               
            ])
            ->add('penalite', TextType::class,[
                'attr' => [
                    'class' => "form-control"
                ], 
                'label' => "Penalité"
            ])
            ->add('delaisPaiem', DateType::class,[
                'attr'=> [
                    'class'=>"form-control"
                ],
                    'widget' => 'choice',
                    'input'  => 'datetime_immutable',
                    'label' => "Date de Location"
               
            ])
            ->add('causionEnt', ChoiceType::class,[
                'choices'=>[
                    '100000'=>'100000',
                    '2000000'=> '2000000',
                    '5000000'=>'5000000',
                    '10000000'=> '10000000',
                ],
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => "Causion d'entrée"
            ])
            ->add('causionSort', ChoiceType::class,[
                'choices'=>[
                    '100000'=>'100000',
                    '2000000'=> '2000000',
                    '5000000'=>'5000000',
                    '10000000'=> '10000000',
                ],
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => "Causion d'entrée"
            ])
            ->add('etatLieu', TextareaType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'label'=>"Etat des lieus"
            ] )
            ->add('dateL', DateType::class,[
                'attr'=> [
                    'class'=>"form-control"
                ],
                    'widget' => 'choice',
                    'input'  => 'datetime_immutable',
                    'label' => "Date de Loyer"
               
            ])
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
        ]);
    }
}
