<?php

namespace App\Form;

use App\Entity\Abilities;
use App\Entity\EggGroups;
use App\Entity\LevelingRate;
use App\Entity\Pkmn;
use App\Entity\PkmnTypes;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class PkmnAndMovesetType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nationalDexID')
            ->add('regionalDexID')
            ->add('formID')
            ->add('name')
            ->add('websiteDescription')
            ->add('categoryName')
            ->add('height')
            ->add('weight')
            ->add('stats', PkmnStatsType::class, [
                'label' => false
            ])
            ->add('evYield', PkmnStatsType::class, [
                'label' => false
            ])
            ->add('baseExpYield', null, ['attr' => ['class' => 'text-input']])
            ->add('baseFriendship')
            ->add('hatchTimeInCycle')
            ->add('cryFile')
            ->add('spriteName')
            ->add('shinySpriteName')
            ->add('artworkName')
            ->add('updatedAt')
            ->add('firstType', EntityType::class, [
                'class' => PkmnTypes::class,
                'choice_label' => 'id',
            ])
            ->add('secondType', EntityType::class, [
                'class' => PkmnTypes::class,
                'choice_label' => 'id',
            ])
            ->add('firstAbility', EntityType::class, [
                'class' => Abilities::class,
                'choice_label' => 'id',
            ])
            ->add('secondAbility', EntityType::class, [
                'class' => Abilities::class,
                'choice_label' => 'id',
            ])
            ->add('hiddenAbility', EntityType::class, [
                'class' => Abilities::class,
                'choice_label' => 'id',
            ])
            ->add('levelingRate', EntityType::class, [
                'class' => LevelingRate::class,
                'choice_label' => 'id',
            ])
            ->add('firstEggGroup', EntityType::class, [
                'class' => EggGroups::class,
                'choice_label' => 'id',
            ])
            ->add('secondEggGroup', EntityType::class, [
                'class' => EggGroups::class,
                'choice_label' => 'id',
            ])

            // --- LA COLLECTION DE MOVESETS ---
            ->add('movesets', CollectionType::class, [
                'entry_type' => MovesetEmbeddedType::class,
                'entry_options' => ['label' => false],
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
                'label' => false
            ])

            ->add('save', SubmitType::class, [
                'label' => 'Save Pokémon & Moves',
                'attr' => ['class' => 'default-button orange-button']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Pkmn::class,
        ]);
    }
}
