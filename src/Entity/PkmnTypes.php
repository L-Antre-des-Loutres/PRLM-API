<?php

namespace App\Entity;

use App\Repository\PkmnTypesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PkmnTypesRepository::class)]
class PkmnTypes
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 15)]
    private string $name;

    #[ORM\Column(type: Types::TEXT)]
    private string $websiteDescription;

    /* -------------------------------------------------------------------------- */
    /* RELATION 1: Super Effective (Offense) <-> Weakness (Defense)               */
    /* -------------------------------------------------------------------------- */

    /**
     * @var Collection<int, self>
     */
    #[ORM\ManyToMany(targetEntity: self::class, inversedBy: 'weakTo')]
    #[ORM\JoinTable(name: 'pkmn_types_super_effective')]
    private Collection $superEffectiveOn;

    /**
     * @var Collection<int, self>
     */
    #[ORM\ManyToMany(targetEntity: self::class, mappedBy: 'superEffectiveOn')]
    private Collection $weakTo;

    /* -------------------------------------------------------------------------- */
    /* RELATION 2: Not Very Effective (Offense) <-> Resistance (Defense)          */
    /* -------------------------------------------------------------------------- */

    /**
     * @var Collection<int, self>
     */
    #[ORM\ManyToMany(targetEntity: self::class, inversedBy: 'resistantTo')]
    #[ORM\JoinTable(name: 'pkmn_types_not_very_effective')]
    private Collection $notVeryEffectiveOn;

    /**
     * @var Collection<int, self>
     */
    #[ORM\ManyToMany(targetEntity: self::class, mappedBy: 'notVeryEffectiveOn')]
    private Collection $resistantTo;

    /* -------------------------------------------------------------------------- */
    /* RELATION 3: No Effect (Offense) <-> Immunity (Defense)                     */
    /* -------------------------------------------------------------------------- */

    /**
     * @var Collection<int, self>
     */
    #[ORM\ManyToMany(targetEntity: self::class, inversedBy: 'immuneFrom')]
    #[ORM\JoinTable(name: 'pkmn_types_no_effect')]
    private Collection $noEffectOn;

    /**
     * @var Collection<int, self>
     */
    #[ORM\ManyToMany(targetEntity: self::class, mappedBy: 'noEffectOn')]
    private Collection $immuneFrom;

    public function __construct()
    {
        $this->superEffectiveOn = new ArrayCollection();
        $this->weakTo = new ArrayCollection();
        $this->notVeryEffectiveOn = new ArrayCollection();
        $this->resistantTo = new ArrayCollection();
        $this->noEffectOn = new ArrayCollection();
        $this->immuneFrom = new ArrayCollection();
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
     * @return Collection<int, self>
     */
    public function getSuperEffectiveOn(): Collection
    {
        return $this->superEffectiveOn;
    }

    public function addSuperEffectiveOn(self $superEffectiveOn): static
    {
        if (!$this->superEffectiveOn->contains($superEffectiveOn)) {
            $this->superEffectiveOn->add($superEffectiveOn);
        }

        return $this;
    }

    public function removeSuperEffectiveOn(self $superEffectiveOn): static
    {
        $this->superEffectiveOn->removeElement($superEffectiveOn);

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getWeakTo(): Collection
    {
        return $this->weakTo;
    }

    public function addWeakTo(self $weakTo): static
    {
        if (!$this->weakTo->contains($weakTo)) {
            $this->weakTo->add($weakTo);
            $weakTo->addSuperEffectiveOn($this);
        }

        return $this;
    }

    public function removeWeakTo(self $weakTo): static
    {
        if ($this->weakTo->removeElement($weakTo)) {
            $weakTo->removeSuperEffectiveOn($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getNotVeryEffectiveOn(): Collection
    {
        return $this->notVeryEffectiveOn;
    }

    public function addNotVeryEffectiveOn(self $notVeryEffectiveOn): static
    {
        if (!$this->notVeryEffectiveOn->contains($notVeryEffectiveOn)) {
            $this->notVeryEffectiveOn->add($notVeryEffectiveOn);
        }

        return $this;
    }

    public function removeNotVeryEffectiveOn(self $notVeryEffectiveOn): static
    {
        $this->notVeryEffectiveOn->removeElement($notVeryEffectiveOn);

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getResistantTo(): Collection
    {
        return $this->resistantTo;
    }

    public function addResistantTo(self $resistantTo): static
    {
        if (!$this->resistantTo->contains($resistantTo)) {
            $this->resistantTo->add($resistantTo);
            $resistantTo->addNotVeryEffectiveOn($this);
        }

        return $this;
    }

    public function removeResistantTo(self $resistantTo): static
    {
        if ($this->resistantTo->removeElement($resistantTo)) {
            $resistantTo->removeNotVeryEffectiveOn($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getNoEffectOn(): Collection
    {
        return $this->noEffectOn;
    }

    public function addNoEffectOn(self $noEffectOn): static
    {
        if (!$this->noEffectOn->contains($noEffectOn)) {
            $this->noEffectOn->add($noEffectOn);
        }

        return $this;
    }

    public function removeNoEffectOn(self $noEffectOn): static
    {
        $this->noEffectOn->removeElement($noEffectOn);

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getImmuneFrom(): Collection
    {
        return $this->immuneFrom;
    }

    public function addImmuneFrom(self $immuneFrom): static
    {
        if (!$this->immuneFrom->contains($immuneFrom)) {
            $this->immuneFrom->add($immuneFrom);
            $immuneFrom->addNoEffectOn($this);
        }

        return $this;
    }

    public function removeImmuneFrom(self $immuneFrom): static
    {
        if ($this->immuneFrom->removeElement($immuneFrom)) {
            $immuneFrom->removeNoEffectOn($this);
        }

        return $this;
    }
}

