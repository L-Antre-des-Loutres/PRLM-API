<?php

namespace App\Entity;

use App\Repository\GameOrRegionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GameOrRegionRepository::class)]
class GameOrRegion
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 20)]
    private string $name;

    #[ORM\Column(length: 100)]
    private string $link;

    #[ORM\Column(length: 20)]
    private string $game;

    #[ORM\Column(type: Types::TEXT)]
    private string $description;

    /**
     * @var Collection<int, PkmnDexEntries>
     */
    #[ORM\OneToMany(targetEntity: PkmnDexEntries::class, mappedBy: 'gameOrRegion', orphanRemoval: true)]
    private Collection $pkmnDexEntries;

    /**
     * @var Collection<int, PkmnSpawns>
     */
    #[ORM\OneToMany(targetEntity: PkmnSpawns::class, mappedBy: 'gameOrRegion', orphanRemoval: true)]
    private Collection $pkmnSpawns;

    public function __construct()
    {
        $this->pkmnDexEntries = new ArrayCollection();
        $this->pkmnSpawns = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getLink(): string
    {
        return $this->link;
    }

    public function setLink(string $link): static
    {
        $this->link = $link;

        return $this;
    }

    public function getGame(): string
    {
        return $this->game;
    }

    public function setGame(string $game): static
    {
        $this->game = $game;

        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, PkmnDexEntries>
     */
    public function getPkmnDexEntries(): Collection
    {
        return $this->pkmnDexEntries;
    }

    public function addPkmnDexEntry(PkmnDexEntries $pkmnDexEntry): static
    {
        if (!$this->pkmnDexEntries->contains($pkmnDexEntry)) {
            $this->pkmnDexEntries->add($pkmnDexEntry);
            $pkmnDexEntry->setGameOrRegion($this);
        }

        return $this;
    }

    public function removePkmnDexEntry(PkmnDexEntries $pkmnDexEntry): static
    {
        if ($this->pkmnDexEntries->removeElement($pkmnDexEntry)) {
            // set the owning side to null (unless already changed)
            if ($pkmnDexEntry->getGameOrRegion() === $this) {
                $pkmnDexEntry->setGameOrRegion(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, PkmnSpawns>
     */
    public function getPkmnSpawns(): Collection
    {
        return $this->pkmnSpawns;
    }

    public function addPkmnSpawn(PkmnSpawns $pkmnSpawn): static
    {
        if (!$this->pkmnSpawns->contains($pkmnSpawn)) {
            $this->pkmnSpawns->add($pkmnSpawn);
            $pkmnSpawn->setGameOrRegion($this);
        }

        return $this;
    }

    public function removePkmnSpawn(PkmnSpawns $pkmnSpawn): static
    {
        if ($this->pkmnSpawns->removeElement($pkmnSpawn)) {
            // set the owning side to null (unless already changed)
            if ($pkmnSpawn->getGameOrRegion() === $this) {
                $pkmnSpawn->setGameOrRegion(null);
            }
        }

        return $this;
    }
}
