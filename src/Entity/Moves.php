<?php

namespace App\Entity;

use App\Enum\MoveCategory;
use App\Enum\MoveRange;
use App\Repository\MovesRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MovesRepository::class)]
class Moves
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 30)]
    private string $name;

    #[ORM\Column(length: 100)]
    private string $inGameDescription;

    #[ORM\Column(type: Types::TEXT)]
    private string $websiteDescription;

    #[ORM\ManyToOne(inversedBy: 'moves')]
    #[ORM\JoinColumn(nullable: false)]
    private PkmnTypes $typeID;

    #[ORM\Column(nullable: true)]
    private ?int $basePower = null;

    #[ORM\Column(nullable: true)]
    private ?int $baseAccuracy = null;

    #[ORM\Column]
    private int $basePP;

    #[ORM\Column(enumType: MoveRange::class)]
    private MoveRange $moveRange;

    #[ORM\Column(enumType: MoveCategory::class)]
    private MoveCategory $Category;

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

    public function getInGameDescription(): ?string
    {
        return $this->inGameDescription;
    }

    public function setInGameDescription(string $inGameDescription): static
    {
        $this->inGameDescription = $inGameDescription;

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

    public function getTypeID(): ?PkmnTypes
    {
        return $this->typeID;
    }

    public function setTypeID(?PkmnTypes $typeID): static
    {
        $this->typeID = $typeID;

        return $this;
    }

    public function getBasePower(): ?int
    {
        return $this->basePower;
    }

    public function setBasePower(?int $basePower): static
    {
        $this->basePower = $basePower;

        return $this;
    }

    public function getBaseAccuracy(): ?int
    {
        return $this->baseAccuracy;
    }

    public function setBaseAccuracy(?int $baseAccuracy): static
    {
        $this->baseAccuracy = $baseAccuracy;

        return $this;
    }

    public function getBasePP(): ?int
    {
        return $this->basePP;
    }

    public function setBasePP(int $basePP): static
    {
        $this->basePP = $basePP;

        return $this;
    }

    public function getMoveRange(): ?MoveRange
    {
        return $this->moveRange;
    }

    public function setMoveRange(MoveRange $moveRange): static
    {
        $this->moveRange = $moveRange;

        return $this;
    }

    public function getCategory(): ?MoveCategory
    {
        return $this->Category;
    }

    public function setCategory(MoveCategory $Category): static
    {
        $this->Category = $Category;

        return $this;
    }
}
