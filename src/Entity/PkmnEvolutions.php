<?php

namespace App\Entity;

use App\Enum\EvolutionCategory;
use App\Repository\PkmnEvolutionsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PkmnEvolutionsRepository::class)]
class PkmnEvolutions
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'futureEvolutions')]
    #[ORM\JoinColumn(nullable: false)]
    private Pkmn $evolvingPkmn;

    #[ORM\ManyToOne(inversedBy: 'pastEvolutions')]
    #[ORM\JoinColumn(nullable: false)]
    private Pkmn $evolvedPkmn;

    #[ORM\Column(enumType: EvolutionCategory::class)]
    private EvolutionCategory $evolutionCategory;

    #[ORM\Column(type: Types::TEXT)]
    private string $evolutionWebsiteDesc;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEvolvingPkmn(): ?Pkmn
    {
        return $this->evolvingPkmn;
    }

    public function setEvolvingPkmn(?Pkmn $evolvingPkmn): static
    {
        $this->evolvingPkmn = $evolvingPkmn;

        return $this;
    }

    public function getEvolvedPkmn(): ?Pkmn
    {
        return $this->evolvedPkmn;
    }

    public function setEvolvedPkmn(?Pkmn $evolvedPkmn): static
    {
        $this->evolvedPkmn = $evolvedPkmn;

        return $this;
    }

    public function getEvolutionCategory(): ?EvolutionCategory
    {
        return $this->evolutionCategory;
    }

    public function setEvolutionCategory(EvolutionCategory $evolutionCategory): static
    {
        $this->evolutionCategory = $evolutionCategory;

        return $this;
    }

    public function getEvolutionWebsiteDesc(): ?string
    {
        return $this->evolutionWebsiteDesc;
    }

    public function setEvolutionWebsiteDesc(string $evolutionWebsiteDesc): static
    {
        $this->evolutionWebsiteDesc = $evolutionWebsiteDesc;

        return $this;
    }
}
