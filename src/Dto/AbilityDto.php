<?php

namespace App\Dto;

use Symfony\Component\Validator\Constraints as Assert;

class AbilityDto
{
    #[Assert\NotBlank]
    #[Assert\Length(max: 20)]
    public string $name;

    #[Assert\NotBlank]
    #[Assert\Length(max: 100)]
    public string $inGameDescription;

    #[Assert\NotBlank]
    public string $websiteDescription;
}
