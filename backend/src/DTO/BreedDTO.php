<?php

namespace App\DTO;

class BreedDTO
{
    private ?int $id;
    private ?string $breedName;
    private ?bool $isDangerous;
    private ?string $petType;

    public function __construct(?int $id, ?string $breedName, ?bool $isDangerous, ?string $petType)
    {
        $this->id = $id;
        $this->breedName = $breedName;
        $this->isDangerous = $isDangerous;
        $this->petType = $petType;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBreedName(): ?string
    {
        return $this->breedName;
    }

    public function getIsDangerous(): ?bool
    {
        return $this->isDangerous;
    }

    public function getPetType(): ?string
    {
        return $this->petType;
    }
}
