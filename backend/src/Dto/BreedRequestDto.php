<?php

namespace App\Dto;

use Symfony\Component\Validator\Constraints as Assert;

class BreedRequestDto
{
    #[Assert\NotBlank]
    #[Assert\Length(max: 100)]
    public string $breedName;

    #[Assert\NotNull]
    #[Assert\Type('boolean')]
    public bool $isDangerous;

    #[Assert\NotNull]
    #[Assert\Type('integer')]
    public int $petTypeId;

    public function __construct(string $breedName, bool $isDangerous, int $petTypeId)
    {
        $this->breedName = $breedName;
        $this->isDangerous = $isDangerous;
        $this->petTypeId = $petTypeId;
    }
}