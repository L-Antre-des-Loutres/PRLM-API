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
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Vich\UploaderBundle\Form\Type\VichImageType;

class PkmnAndMovesetType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nationalDexID', null, [
                'required' => true
            ])
            ->add('regionalDexID', null, [
                'required' => true
            ])
            ->add('formID', null, [
                'required' => true
            ])
            ->add('name', null, [
                'required' => true
            ])
            ->add('websiteDescription', null, [
                'required' => true
            ])
            ->add('categoryName', null, [
                'required' => true
            ])
            ->add('height', null, [
                'required' => true
            ])
            ->add('weight', null, [
                'required' => true
            ])
            ->add('stats', PkmnStatsType::class, [
                'required' => true,
                'label' => false
            ])
            ->add('evYield', PkmnStatsType::class, [
                'required' => true,
                'label' => false
            ])
            ->add('baseExpYield', null, ['attr' => ['class' => 'text-input'], 'required' => true])
            ->add('baseFriendship', null, [
                'required' => true
            ])
            ->add('hatchTimeInCycle', null, [
                'required' => true
            ])
            ->add('cryFile')
            ->add('spriteFile', VichImageType::class, [
                'required' => false,
                'allow_delete' => true,
                'delete_label' => 'Delete current image',
                'download_uri' => false,
                'image_uri' => true,
                'asset_helper' => true,
                'label' => 'Sprite File',
                'attr' => ['class' => 'file-input']
            ])
            ->add('shinySpriteFile', VichImageType::class, [
                'required' => false,
                'allow_delete' => true,
                'delete_label' => 'Delete current image',
                'download_uri' => false,
                'image_uri' => true,
                'asset_helper' => true,
                'label' => 'Shiny File',
                'attr' => ['class' => 'file-input']
            ])
            ->add('artworkFile', VichImageType::class, [
                'required' => false,
                'allow_delete' => true,
                'delete_label' => 'Delete current image',
                'download_uri' => false,
                'image_uri' => true,
                'asset_helper' => true,
                'label' => 'Artwork File',
                'attr' => ['class' => 'file-input']
            ])
            ->add('firstType', EntityType::class, [
                'class' => PkmnTypes::class,
                'choice_label' => 'name',
            ])
            ->add('secondType', EntityType::class, [
                'class' => PkmnTypes::class,
                'choice_label' => 'name',
            ])
            ->add('firstAbility', EntityType::class, [
                'required' => true,
                'class' => Abilities::class,
                'choice_label' => 'name',
            ])
            ->add('secondAbility', EntityType::class, [
                'required' => false,
                'class' => Abilities::class,
                'choice_label' => 'name',
            ])
            ->add('hiddenAbility', EntityType::class, [
                'class' => Abilities::class,
                'choice_label' => 'name',
            ])
            ->add('levelingRate', EntityType::class, [
                'class' => LevelingRate::class,
                'choice_label' => 'name',
            ])
            ->add('firstEggGroup', EntityType::class, [
                'class' => EggGroups::class,
                'choice_label' => 'name',
            ])
            ->add('secondEggGroup', EntityType::class, [
                'class' => EggGroups::class,
                'choice_label' => 'name',
            ])
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
