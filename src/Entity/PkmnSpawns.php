<?php

namespace App\Entity;

use App\Repository\PkmnSpawnsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PkmnSpawnsRepository::class)]
class PkmnSpawns
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'pkmnSpawns')]
    #[ORM\JoinColumn(nullable: false)]
    private Pkmn $pkmn;

    #[ORM\ManyToOne(inversedBy: 'pkmnSpawns')]
    #[ORM\JoinColumn(nullable: false)]
    private GameOrRegion $gameOrRegion;

    #[ORM\Column(type: Types::TEXT)]
    private string $spawnDescription;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPkmn(): ?Pkmn
    {
        return $this->pkmn;
    }

    public function setPkmn(?Pkmn $pkmn): static
    {
        $this->pkmn = $pkmn;

        return $this;
    }

    public function getGameOrRegion(): ?GameOrRegion
    {
        return $this->gameOrRegion;
    }

    public function setGameOrRegion(?GameOrRegion $gameOrRegion): static
    {
        $this->gameOrRegion = $gameOrRegion;

        return $this;
    }

    public function getSpawnDescription(): ?string
    {
        return $this->spawnDescription;
    }

    public function setSpawnDescription(string $spawnDescription): static
    {
        $this->spawnDescription = $spawnDescription;

        return $this;
    }
}
