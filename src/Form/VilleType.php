<?php

namespace App\Form;

use App\Entity\Pays;
use App\Entity\Ville;
use App\Repository\PaysRepository;
use PhpParser\Parser\Multiple;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Choice;

class VilleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomV' , TextType::class,[
                'attr' => [
                    'class' => "form-control"
                ],
                'label' => "Nom" 
            ])
            ->add('codePostV' , TextType::class,[
                'attr' => [
                    'class' => "form-control"
                ], 
                'label' => "Nom"
            ])
            ->add('pays',EntityType::class,[
                'class'=> Pays::class,
                'query_bulder'=> function(PaysRepository $r){
                    return $r -> createQueryBuilder('i')
                    ->orderBy('i.name','ASC');
                },
                'Choice_label'=>'name',
                'Multiple' => 'true',
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
