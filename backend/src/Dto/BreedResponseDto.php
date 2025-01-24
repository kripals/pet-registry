<?php

namespace App\Dto;

class BreedResponseDto
{
    public int $id;
    public string $breedName;
    public bool $isDangerous;
    public string $petType;

    public function __construct(int $id, string $breedName, bool $isDangerous, string $petType)
    {
        $this->id = $id;
        $this->breedName = $breedName;
        $this->isDangerous = $isDangerous;
        $this->petType = $petType;
    }
}