<?php

namespace App\DTO;

class PetBreedDTO
{
    private int $id;
    private int $breedId;
    private int $petDetailId;

    public function __construct(int $id, int $breedId, int $petDetailId)
    {
        $this->id = $id;
        $this->breedId = $breedId;
        $this->petDetailId = $petDetailId;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getBreedId(): int
    {
        return $this->breedId;
    }

    public function getPetDetailId(): int
    {
        return $this->petDetailId;
    }
}
