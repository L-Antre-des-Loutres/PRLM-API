<?php

namespace App\Entity;

use App\Repository\MovesetsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MovesetsRepository::class)]
class Movesets
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'movesets')]
    #[ORM\JoinColumn(nullable: false)]
    private ?pkmn $pkmn = null;

    #[ORM\ManyToOne(inversedBy: 'movesets')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Moves $move = null;

    #[ORM\Column]
    private ?bool $evolutionLearned = null;

    #[ORM\Column]
    private ?bool $ctLearned = null;

    #[ORM\Column]
    private ?bool $eggMoveLearned = null;

    #[ORM\Column(nullable: true)]
    private ?int $learnAtLevel = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPkmn(): ?pkmn
    {
        return $this->pkmn;
    }

    public function setPkmn(?pkmn $pkmn): static
    {
        $this->pkmn = $pkmn;

        return $this;
    }

    public function getMove(): ?Moves
    {
        return $this->move;
    }

    public function setMove(?Moves $move): static
    {
        $this->move = $move;

        return $this;
    }

    public function isEvolutionLearned(): ?bool
    {
        return $this->evolutionLearned;
    }

    public function setEvolutionLearned(bool $evolutionLearned): static
    {
        $this->evolutionLearned = $evolutionLearned;

        return $this;
    }

    public function isCtLearned(): ?bool
    {
        return $this->ctLearned;
    }

    public function setCtLearned(bool $ctLearned): static
    {
        $this->ctLearned = $ctLearned;

        return $this;
    }

    public function isEggMoveLearned(): ?bool
    {
        return $this->eggMoveLearned;
    }

    public function setEggMoveLearned(bool $eggMoveLearned): static
    {
        $this->eggMoveLearned = $eggMoveLearned;

        return $this;
    }

    public function getLearnAtLevel(): ?int
    {
        return $this->learnAtLevel;
    }

    public function setLearnAtLevel(?int $learnAtLevel): static
    {
        $this->learnAtLevel = $learnAtLevel;

        return $this;
    }
}
