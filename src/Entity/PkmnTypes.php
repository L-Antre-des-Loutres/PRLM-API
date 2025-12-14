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

    /**
     * @var Collection<int, self>
     */
    #[ORM\ManyToMany(targetEntity: self::class, inversedBy: 'immuneFrom')]
    #[ORM\JoinTable(name: 'pkmn_types_immunities')]
    private Collection $immuneToList;

    /**
     * @var Collection<int, self>
     */
    #[ORM\ManyToMany(targetEntity: self::class, mappedBy: 'immuneToList')]
    private Collection $immuneFrom;

    /**
     * @var Collection<int, self>
     */
    #[ORM\ManyToMany(targetEntity: self::class, inversedBy: 'resistantFrom')]
    #[ORM\JoinTable(name: 'pkmn_types_resistances')]
    private Collection $resistantTo;

    /**
     * @var Collection<int, self>
     */
    #[ORM\ManyToMany(targetEntity: self::class, mappedBy: 'resistantTo')]
    private Collection $resistantFrom;

    /**
     * @var Collection<int, self>
     */
    #[ORM\ManyToMany(targetEntity: self::class, inversedBy: 'weakFrom')]
    #[ORM\JoinTable(name: 'pkmn_types_weaknesses')]
    private Collection $weakTo;

    /**
     * @var Collection<int, self>
     */
    #[ORM\ManyToMany(targetEntity: self::class, mappedBy: 'weakTo')]
    private Collection $weakFrom;

    /**
     * @var Collection<int, self>
     */
    #[ORM\ManyToMany(targetEntity: self::class, inversedBy: 'noEffectFrom')]
    #[ORM\JoinTable(name: 'pkmn_types_no_effect')]
    private Collection $noEffectOn;

    /**
     * @var Collection<int, self>
     */
    #[ORM\ManyToMany(targetEntity: self::class, mappedBy: 'noEffectOn')]
    private Collection $noEffectFrom;

    /**
     * @var Collection<int, self>
     */
    #[ORM\ManyToMany(targetEntity: self::class, inversedBy: 'superEffectiveFrom')]
    #[ORM\JoinTable(name: 'pkmn_types_super_effective')]
    private Collection $superEffectiveOn;

    /**
     * @var Collection<int, self>
     */
    #[ORM\ManyToMany(targetEntity: self::class, mappedBy: 'superEffectiveOn')]
    private Collection $superEffectiveFrom;

    /**
     * @var Collection<int, self>
     */
    #[ORM\ManyToMany(targetEntity: self::class, inversedBy: 'notVeryEffectiveFrom')]
    #[ORM\JoinTable(name: 'pkmn_types_not_very_effective')]
    private Collection $notVeryEffectiveOn;

    /**
     * @var Collection<int, self>
     */
    #[ORM\ManyToMany(targetEntity: self::class, mappedBy: 'notVeryEffectiveOn')]
    private Collection $notVeryEffectiveFrom;

    public function __construct()
    {
        $this->immuneToList = new ArrayCollection();
        $this->immuneFrom = new ArrayCollection();
        $this->resistantTo = new ArrayCollection();
        $this->resistantFrom = new ArrayCollection();
        $this->weakTo = new ArrayCollection();
        $this->weakFrom = new ArrayCollection();
        $this->noEffectOn = new ArrayCollection();
        $this->noEffectFrom = new ArrayCollection();
        $this->superEffectiveOn = new ArrayCollection();
        $this->superEffectiveFrom = new ArrayCollection();
        $this->notVeryEffectiveOn = new ArrayCollection();
        $this->notVeryEffectiveFrom = new ArrayCollection();
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
    public function getImmuneToList(): Collection
    {
        return $this->immuneToList;
    }

    public function addImmuneToList(self $immuneToList): static
    {
        if (!$this->immuneToList->contains($immuneToList)) {
            $this->immuneToList->add($immuneToList);
        }

        return $this;
    }

    public function removeImmuneToList(self $immuneToList): static
    {
        $this->immuneToList->removeElement($immuneToList);

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
            $immuneFrom->addImmuneToList($this);
        }

        return $this;
    }

    public function removeImmuneFrom(self $immuneFrom): static
    {
        if ($this->immuneFrom->removeElement($immuneFrom)) {
            $immuneFrom->removeImmuneToList($this);
        }

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
        }

        return $this;
    }

    public function removeResistantTo(self $resistantTo): static
    {
        $this->resistantTo->removeElement($resistantTo);

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getResistantFrom(): Collection
    {
        return $this->resistantFrom;
    }

    public function addResistantFrom(self $resistantFrom): static
    {
        if (!$this->resistantFrom->contains($resistantFrom)) {
            $this->resistantFrom->add($resistantFrom);
            $resistantFrom->addResistantTo($this);
        }

        return $this;
    }

    public function removeResistantFrom(self $resistantFrom): static
    {
        if ($this->resistantFrom->removeElement($resistantFrom)) {
            $resistantFrom->removeResistantTo($this);
        }

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
        }

        return $this;
    }

    public function removeWeakTo(self $weakTo): static
    {
        $this->weakTo->removeElement($weakTo);

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getWeakFrom(): Collection
    {
        return $this->weakFrom;
    }

    public function addWeakFrom(self $weakFrom): static
    {
        if (!$this->weakFrom->contains($weakFrom)) {
            $this->weakFrom->add($weakFrom);
            $weakFrom->addWeakTo($this);
        }

        return $this;
    }

    public function removeWeakFrom(self $weakFrom): static
    {
        if ($this->weakFrom->removeElement($weakFrom)) {
            $weakFrom->removeWeakTo($this);
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
    public function getNoEffectFrom(): Collection
    {
        return $this->noEffectFrom;
    }

    public function addNoEffectFrom(self $noEffectFrom): static
    {
        if (!$this->noEffectFrom->contains($noEffectFrom)) {
            $this->noEffectFrom->add($noEffectFrom);
            $noEffectFrom->addNoEffectOn($this);
        }

        return $this;
    }

    public function removeNoEffectFrom(self $noEffectFrom): static
    {
        if ($this->noEffectFrom->removeElement($noEffectFrom)) {
            $noEffectFrom->removeNoEffectOn($this);
        }

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
    public function getSuperEffectiveFrom(): Collection
    {
        return $this->superEffectiveFrom;
    }

    public function addSuperEffectiveFrom(self $superEffectiveFrom): static
    {
        if (!$this->superEffectiveFrom->contains($superEffectiveFrom)) {
            $this->superEffectiveFrom->add($superEffectiveFrom);
            $superEffectiveFrom->addSuperEffectiveOn($this);
        }

        return $this;
    }

    public function removeSuperEffectiveFrom(self $superEffectiveFrom): static
    {
        if ($this->superEffectiveFrom->removeElement($superEffectiveFrom)) {
            $superEffectiveFrom->removeSuperEffectiveOn($this);
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
    public function getNotVeryEffectiveFrom(): Collection
    {
        return $this->notVeryEffectiveFrom;
    }

    public function addNotVeryEffectiveFrom(self $notVeryEffectiveFrom): static
    {
        if (!$this->notVeryEffectiveFrom->contains($notVeryEffectiveFrom)) {
            $this->notVeryEffectiveFrom->add($notVeryEffectiveFrom);
            $notVeryEffectiveFrom->addNotVeryEffectiveOn($this);
        }

        return $this;
    }

    public function removeNotVeryEffectiveFrom(self $notVeryEffectiveFrom): static
    {
        if ($this->notVeryEffectiveFrom->removeElement($notVeryEffectiveFrom)) {
            $notVeryEffectiveFrom->removeNotVeryEffectiveOn($this);
        }

        return $this;
    }
}
