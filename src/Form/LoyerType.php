<?php

namespace App\Form;

use App\Entity\Loyer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LoyerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('prixLoyer')
            ->add('coutL')
            ->add('dateLoyer')
            ->add('typePaie')
            ->add('statutLoy')
            ->add('MontLoy')
            ->add('appliPenal')
            ->add('mois')
            ->add('annee')
            ->add('modePaie')
            ->add('refPaie')
            ->add('montPaie')
            ->add('location')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Loyer::class,
        ]);
    }
}
