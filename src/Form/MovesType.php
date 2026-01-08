<?php

namespace App\Form;

use App\Entity\Moves;
use App\Entity\PkmnTypes;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MovesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('inGameDescription')
            ->add('websiteDescription')
            ->add('basePower')
            ->add('baseAccuracy')
            ->add('basePP')
            ->add('moveRange')
            ->add('Category')
            ->add('typeID', EntityType::class, [
                'class' => PkmnTypes::class,
                'choice_label' => 'id',
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Save'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Moves::class,
        ]);
    }
}
