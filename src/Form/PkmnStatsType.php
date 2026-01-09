<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PkmnStatsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('hp', IntegerType::class, ['label' => 'HP', 'attr' => ['class' => 'text-input']])
            ->add('attack', IntegerType::class, ['label' => 'Atk', 'attr' => ['class' => 'text-input']])
            ->add('defense', IntegerType::class, ['label' => 'Def', 'attr' => ['class' => 'text-input']])
            ->add('special_attack', IntegerType::class, ['label' => 'SpA', 'attr' => ['class' => 'text-input']])
            ->add('special_defense', IntegerType::class, ['label' => 'SpD', 'attr' => ['class' => 'text-input']])
            ->add('speed', IntegerType::class, ['label' => 'Spe', 'attr' => ['class' => 'text-input']])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([]);
    }
}
