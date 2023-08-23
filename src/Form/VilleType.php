<?php

namespace App\Form;

use App\Entity\Pays;
use App\Entity\Ville;
use App\Repository\PaysRepository;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Doctrine\ORM\QueryBuilder;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;



class VilleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomV', TextType::class, [
                'attr' => [
                    'class' => "form-control"
                ], 
                'label' => "Nom"
            ])
            ->add('codePostV',TextType::class, [
                'attr' => [
                    'class' => "form-control"
                ], 
                'label' => "code postal"
            ])
            ->add('pays',EntityType::class,[
                'class' => Pays::class,
                'query_builder' => function (PaysRepository $er): QueryBuilder {
                    return $er->createQueryBuilder('i')
                        ->orderBy('i.nomP', 'ASC');
                },
                'attr' => [
                    'class' => "form-control"
                ],

                'choice_label' => 'nomP',
            
                ]
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Ville::class,
        ]);
    }
    
}
