<?php

namespace App\Entity;

use App\Repository\PkmnDexEntriesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PkmnDexEntriesRepository::class)]
class PkmnDexEntries
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'pkmnDexEntries')]
    #[ORM\JoinColumn(nullable: false)]
    private Pkmn $pkmn;

    #[ORM\ManyToOne(inversedBy: 'pkmnDexEntries')]
    #[ORM\JoinColumn(nullable: false)]
    private GameOrRegion $gameOrRegion;

    #[ORM\Column(length: 200)]
    private string $entry;

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

    public function getEntry(): ?string
    {
        return $this->entry;
    }

    public function setEntry(string $entry): static
    {
        $this->entry = $entry;

        return $this;
    }
}
