<?php

namespace App\Form;

use App\Entity\Moves;
use App\Entity\Movesets;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MovesetEmbeddedType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('move', EntityType::class, [
                'class' => Moves::class,
                'choice_label' => 'name',
                'label' => 'Attaque',
                'attr' => ['class' => 'text-input']
            ])
            ->add('learnAtLevel', IntegerType::class, [
                'label' => 'Niveau',
                'required' => false,
                'attr' => ['class' => 'text-input']
            ])
            ->add('evolutionLearned', CheckboxType::class, [
                'label' => 'Evo.',
                'required' => false,
                'attr' => ['class' => 'form-check-input']
            ])
            ->add('ctLearned', CheckboxType::class, [
                'label' => 'CT',
                'required' => false,
                'attr' => ['class' => 'form-check-input']
            ])
            ->add('eggMoveLearned', CheckboxType::class, [
                'label' => 'Egg',
                'required' => false,
                'attr' => ['class' => 'form-check-input']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Movesets::class,
        ]);
    }
}
