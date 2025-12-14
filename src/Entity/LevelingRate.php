<?php

namespace App\Entity;

use App\Repository\LevelingRateRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LevelingRateRepository::class)]
class LevelingRate
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 20)]
    private string $name;

    #[ORM\Column(type: Types::TEXT)]
    private string $websiteDescription;

    /**
     * @var Collection<int, Pkmn>
     */
    #[ORM\OneToMany(targetEntity: Pkmn::class, mappedBy: 'levelingRate')]
    private Collection $pkmns;

    public function __construct()
    {
        $this->pkmns = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getWebsiteDescription(): ?string
    {
        return $this->websiteDescription;
    }

    public function setWebsiteDescription(string $websiteDescription): static
    {
        $this->websiteDescription = $websiteDescription;

        return $this;
    }

    /**
     * @return Collection<int, Pkmn>
     */
    public function getPkmns(): Collection
    {
        return $this->pkmns;
    }

    public function addPkmn(Pkmn $pkmn): static
    {
        if (!$this->pkmns->contains($pkmn)) {
            $this->pkmns->add($pkmn);
            $pkmn->setLevelingRate($this);
        }

        return $this;
    }

    public function removePkmn(Pkmn $pkmn): static
    {
        if ($this->pkmns->removeElement($pkmn)) {
            // set the owning side to null (unless already changed)
            if ($pkmn->getLevelingRate() === $this) {
                $pkmn->setLevelingRate(null);
            }
        }

        return $this;
    }
}
