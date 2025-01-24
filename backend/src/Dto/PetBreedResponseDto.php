<?php

namespace App\Dto;

class PetBreedResponseDto
{
    public int $id;
    public int $breedId;
    public int $petDetailId;

    public function __construct(int $id, int $breedId, int $petDetailId)
    {
        $this->id = $id;
        $this->breedId = $breedId;
        $this->petDetailId = $petDetailId;
    }
}