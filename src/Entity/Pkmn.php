<?php

namespace App\Entity;

use App\Repository\PkmnRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\MaxDepth;

#[ORM\Entity(repositoryClass: PkmnRepository::class)]
class Pkmn
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['pkmn:read'])]
    private ?int $id = null;

    #[ORM\Column]
    #[Groups(['pkmn:read'])]
    private int $regionalDexID;

    #[ORM\Column(length: 20)]
    #[Groups(['pkmn:read'])]
    private string $name;

    #[ORM\Column(type: Types::TEXT)]
    #[Groups(['pkmn:read'])]
    private string $websiteDescription;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['pkmn:read'])]
    private PkmnTypes $firstType;

    #[ORM\ManyToOne]
    #[Groups(['pkmn:read'])]
    private ?PkmnTypes $secondType = null;

    #[ORM\Column(length: 30)]
    #[Groups(['pkmn:read'])]
    private string $categoryName;

    #[ORM\Column]
    #[Groups(['pkmn:read'])]
    private int $height;

    #[ORM\Column]
    #[Groups(['pkmn:read'])]
    private int $weight;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['pkmn:read'])]
    private Abilities $firstAbility;

    #[ORM\ManyToOne]
    #[Groups(['pkmn:read'])]
    private ?Abilities $secondAbility = null;

    #[ORM\ManyToOne]
    #[Groups(['pkmn:read'])]
    private ?Abilities $hiddenAbility = null;

    #[ORM\Column]
    #[Groups(['pkmn:read'])]
    private int $evYieldStat;

    #[ORM\Column]
    #[Groups(['pkmn:read'])]
    private int $evYieldQuantity;

    #[ORM\Column]
    #[Groups(['pkmn:read'])]
    private int $baseExpYield;

    #[ORM\ManyToOne(inversedBy: 'pkmns')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['pkmn:read'])]
    private LevelingRate $levelingRate;

    #[ORM\Column]
    #[Groups(['pkmn:read'])]
    private int $baseFriendship;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['pkmn:read'])]
    private EggGroups $firstEggGroup;

    #[ORM\ManyToOne]
    #[Groups(['pkmn:read'])]
    private ?EggGroups $secondEggGroup = null;

    #[ORM\Column]
    #[Groups(['pkmn:read'])]
    private int $hatchTimeInCycle;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    #[Groups(['pkmn:read'])]
    private ?string $cryFile = null;

    /**
     * @var Collection<int, Movesets>
     */
    #[ORM\OneToMany(targetEntity: Movesets::class, mappedBy: 'pkmn', orphanRemoval: true)]
    #[Groups(['pkmn:read'])]
    private Collection $movesets;

    /**
     * @var Collection<int, PkmnEvolutions>
     */
    #[ORM\OneToMany(targetEntity: PkmnEvolutions::class, mappedBy: 'evolvingPkmn', orphanRemoval: true)]
    #[Groups(['pkmn:read'])]
    #[MaxDepth(1)]
    private Collection $futureEvolutions;

    /**
     * @var Collection<int, PkmnEvolutions>
     */
    #[ORM\OneToMany(targetEntity: PkmnEvolutions::class, mappedBy: 'evolvedPkmn', orphanRemoval: true)]
    #[Groups(['pkmn:read'])]
    #[MaxDepth(1)]
    private Collection $pastEvolutions;

    /**
     * @var Collection<int, PkmnDexEntries>
     */
    #[ORM\OneToMany(targetEntity: PkmnDexEntries::class, mappedBy: 'pkmn', orphanRemoval: true)]
    #[Groups(['pkmn:read'])]
    private Collection $pkmnDexEntries;

    /**
     * @var Collection<int, PkmnSpawns>
     */
    #[ORM\OneToMany(targetEntity: PkmnSpawns::class, mappedBy: 'pkmn', orphanRemoval: true)]
    #[Groups(['pkmn:read'])]
    private Collection $pkmnSpawns;

    // =======
    // SPRITES
    // =======

    #[Vich\UploadableField(mapping: 'pkmn_images', fileNameProperty: 'spriteName')]
    private ?File $spriteFile = null;

    #[ORM\Column(nullable: true)]
    private ?string $spriteName = null;

    #[Vich\UploadableField(mapping: 'pkmn_images', fileNameProperty: 'shinySpriteName')]
    private ?File $shinySpriteFile = null;

    #[ORM\Column(nullable: true)]
    private ?string $shinySpriteName = null;

    #[Vich\UploadableField(mapping: 'pkmn_images', fileNameProperty: 'artworkName')]
    private ?File $artworkFile = null;

    #[ORM\Column(nullable: true)]
    private ?string $artworkName = null;

    // ==========
    // UPDATED AT
    // ==========

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $updatedAt = null;

    public function __construct()
    {
        $this->movesets = new ArrayCollection();
        $this->futureEvolutions = new ArrayCollection();
        $this->pastEvolutions = new ArrayCollection();
        $this->pkmnDexEntries = new ArrayCollection();
        $this->pkmnSpawns = new ArrayCollection();
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

    /**
     * @return Collection<int, PkmnEvolutions>
     */
    public function getFutureEvolutions(): Collection
    {
        return $this->futureEvolutions;
    }

    public function addFutureEvolution(PkmnEvolutions $futureEvolution): static
    {
        if (!$this->futureEvolutions->contains($futureEvolution)) {
            $this->futureEvolutions->add($futureEvolution);
            $futureEvolution->setEvolvingPkmn($this);
        }

        return $this;
    }

    public function removeFutureEvolution(PkmnEvolutions $futureEvolution): static
    {
        if ($this->futureEvolutions->removeElement($futureEvolution)) {
            // set the owning side to null (unless already changed)
            if ($futureEvolution->getEvolvingPkmn() === $this) {
                $futureEvolution->setEvolvingPkmn(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, PkmnEvolutions>
     */
    public function getPastEvolutions(): Collection
    {
        return $this->pastEvolutions;
    }

    public function addPastEvolution(PkmnEvolutions $pastEvolution): static
    {
        if (!$this->pastEvolutions->contains($pastEvolution)) {
            $this->pastEvolutions->add($pastEvolution);
            $pastEvolution->setEvolvedPkmn($this);
        }

        return $this;
    }

    public function removePastEvolution(PkmnEvolutions $pastEvolution): static
    {
        if ($this->pastEvolutions->removeElement($pastEvolution)) {
            // set the owning side to null (unless already changed)
            if ($pastEvolution->getEvolvedPkmn() === $this) {
                $pastEvolution->setEvolvedPkmn(null);
            }
        }

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
            $pkmnDexEntry->setPkmn($this);
        }

        return $this;
    }

    public function removePkmnDexEntry(PkmnDexEntries $pkmnDexEntry): static
    {
        if ($this->pkmnDexEntries->removeElement($pkmnDexEntry)) {
            // set the owning side to null (unless already changed)
            if ($pkmnDexEntry->getPkmn() === $this) {
                $pkmnDexEntry->setPkmn(null);
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
            $pkmnSpawn->setPkmn($this);
        }

        return $this;
    }

    public function removePkmnSpawn(PkmnSpawns $pkmnSpawn): static
    {
        if ($this->pkmnSpawns->removeElement($pkmnSpawn)) {
            // set the owning side to null (unless already changed)
            if ($pkmnSpawn->getPkmn() === $this) {
                $pkmnSpawn->setPkmn(null);
            }
        }

        return $this;
    }

    public function getSpriteFile(): ?File
    {
        return $this->spriteFile;
    }

    public function setSpriteFile(?File $spriteFile): void
    {
        $this->spriteFile = $spriteFile;
    }

    public function getSpriteName(): ?string
    {
        return $this->spriteName;
    }

    public function setSpriteName(?string $spriteName): void
    {
        $this->spriteName = $spriteName;
    }

    public function getShinySpriteFile(): ?File
    {
        return $this->shinySpriteFile;
    }

    public function setShinySpriteFile(?File $shinySpriteFile): void
    {
        $this->shinySpriteFile = $shinySpriteFile;
    }

    public function getShinySpriteName(): ?string
    {
        return $this->shinySpriteName;
    }

    public function setShinySpriteName(?string $shinySpriteName): void
    {
        $this->shinySpriteName = $shinySpriteName;
    }

    public function getArtworkFile(): ?File
    {
        return $this->artworkFile;
    }

    public function setArtworkFile(?File $artworkFile): void
    {
        $this->artworkFile = $artworkFile;
    }

    public function getArtworkName(): ?string
    {
        return $this->artworkName;
    }

    public function setArtworkName(?string $artworkName): void
    {
        $this->artworkName = $artworkName;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeInterface $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }
}
