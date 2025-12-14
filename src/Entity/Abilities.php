<?php

namespace App\Entity;

use App\Repository\AbilitiesRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AbilitiesRepository::class)]
class Abilities
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 20)]
    private string $name;

    #[ORM\Column(length: 100)]
    private string $inGameDescription;

    #[ORM\Column(type: Types::TEXT)]
    private string $websiteDescription;

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
}
