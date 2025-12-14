<?php

namespace App\Entity;

use App\Repository\PkmnRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PkmnRepository::class)]
class Pkmn
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private int $regionalDexID;

    #[ORM\Column(length: 20)]
    private string $name;

    #[ORM\Column(type: Types::TEXT)]
    private string $websiteDescription;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private PkmnTypes $firstType;

    #[ORM\ManyToOne]
    private ?PkmnTypes $secondType = null;

    #[ORM\Column(length: 30)]
    private string $categoryName;

    #[ORM\Column]
    private int $height;

    #[ORM\Column]
    private int $weight;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private Abilities $firstAbility;

    #[ORM\ManyToOne]
    private ?Abilities $secondAbility = null;

    #[ORM\ManyToOne]
    private ?Abilities $hiddenAbility = null;

    #[ORM\Column]
    private int $evYieldStat;

    #[ORM\Column]
    private int $evYieldQuantity;

    #[ORM\Column]
    private int $baseExpYield;

    #[ORM\ManyToOne(inversedBy: 'pkmns')]
    #[ORM\JoinColumn(nullable: false)]
    private LevelingRate $levelingRate;

    #[ORM\Column]
    private int $baseFriendship;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private EggGroups $firstEggGroup;

    #[ORM\ManyToOne]
    private ?EggGroups $secondEggGroup = null;

    #[ORM\Column]
    private int $hatchTimeInCycle;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $cryFile = null;

    /**
     * @var Collection<int, Movesets>
     */
    #[ORM\OneToMany(targetEntity: Movesets::class, mappedBy: 'pkmn', orphanRemoval: true)]
    private Collection $movesets;

    public function __construct()
    {
        $this->movesets = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRegionalDexID(): ?int
    {
        return $this->regionalDexID;
    }

    public function setRegionalDexID(int $regionalDexID): static
    {
        $this->regionalDexID = $regionalDexID;

        return $this;
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

    public function getFirstType(): ?PkmnTypes
    {
        return $this->firstType;
    }

    public function setFirstType(?PkmnTypes $firstType): static
    {
        $this->firstType = $firstType;

        return $this;
    }

    public function getSecondType(): ?PkmnTypes
    {
        return $this->secondType;
    }

    public function setSecondType(?PkmnTypes $secondType): static
    {
        $this->secondType = $secondType;

        return $this;
    }

    public function getCategoryName(): ?string
    {
        return $this->categoryName;
    }

    public function setCategoryName(string $categoryName): static
    {
        $this->categoryName = $categoryName;

        return $this;
    }

    public function getHeight(): ?int
    {
        return $this->height;
    }

    public function setHeight(int $height): static
    {
        $this->height = $height;

        return $this;
    }

    public function getWeight(): ?int
    {
        return $this->weight;
    }

    public function setWeight(int $weight): static
    {
        $this->weight = $weight;

        return $this;
    }

    public function getFirstAbility(): ?Abilities
    {
        return $this->firstAbility;
    }

    public function setFirstAbility(?Abilities $firstAbility): static
    {
        $this->firstAbility = $firstAbility;

        return $this;
    }

    public function getSecondAbility(): ?Abilities
    {
        return $this->secondAbility;
    }

    public function setSecondAbility(?Abilities $secondAbility): static
    {
        $this->secondAbility = $secondAbility;

        return $this;
    }

    public function getHiddenAbility(): ?Abilities
    {
        return $this->hiddenAbility;
    }

    public function setHiddenAbility(?Abilities $hiddenAbility): static
    {
        $this->hiddenAbility = $hiddenAbility;

        return $this;
    }

    public function getEvYieldStat(): ?int
    {
        return $this->evYieldStat;
    }

    public function setEvYieldStat(int $evYieldStat): static
    {
        $this->evYieldStat = $evYieldStat;

        return $this;
    }

    public function getEvYieldQuantity(): ?int
    {
        return $this->evYieldQuantity;
    }

    public function setEvYieldQuantity(int $evYieldQuantity): static
    {
        $this->evYieldQuantity = $evYieldQuantity;

        return $this;
    }

    public function getBaseExpYield(): ?int
    {
        return $this->baseExpYield;
    }

    public function setBaseExpYield(int $baseExpYield): static
    {
        $this->baseExpYield = $baseExpYield;

        return $this;
    }

    public function getLevelingRate(): ?LevelingRate
    {
        return $this->levelingRate;
    }

    public function setLevelingRate(?LevelingRate $levelingRate): static
    {
        $this->levelingRate = $levelingRate;

        return $this;
    }

    public function getBaseFriendship(): ?int
    {
        return $this->baseFriendship;
    }

    public function setBaseFriendship(int $baseFriendship): static
    {
        $this->baseFriendship = $baseFriendship;

        return $this;
    }

    public function getFirstEggGroup(): ?EggGroups
    {
        return $this->firstEggGroup;
    }

    public function setFirstEggGroup(?EggGroups $firstEggGroup): static
    {
        $this->firstEggGroup = $firstEggGroup;

        return $this;
    }

    public function getSecondEggGroup(): ?EggGroups
    {
        return $this->secondEggGroup;
    }

    public function setSecondEggGroup(?EggGroups $secondEggGroup): static
    {
        $this->secondEggGroup = $secondEggGroup;

        return $this;
    }

    public function getHatchTimeInCycle(): ?int
    {
        return $this->hatchTimeInCycle;
    }

    public function setHatchTimeInCycle(int $hatchTimeInCycle): static
    {
        $this->hatchTimeInCycle = $hatchTimeInCycle;

        return $this;
    }

    public function getCryFile(): ?string
    {
        return $this->cryFile;
    }

    public function setCryFile(?string $cryFile): static
    {
        $this->cryFile = $cryFile;

        return $this;
    }

    /**
     * @return Collection<int, Movesets>
     */
    public function getMovesets(): Collection
    {
        return $this->movesets;
    }

    public function addMoveset(Movesets $moveset): static
    {
        if (!$this->movesets->contains($moveset)) {
            $this->movesets->add($moveset);
            $moveset->setPkmn($this);
        }

        return $this;
    }

    public function removeMoveset(Movesets $moveset): static
    {
        if ($this->movesets->removeElement($moveset)) {
            // set the owning side to null (unless already changed)
            if ($moveset->getPkmn() === $this) {
                $moveset->setPkmn(null);
            }
        }

        return $this;
    }
}
