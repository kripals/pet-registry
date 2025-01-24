<?php

namespace App\Dto;

use Symfony\Component\Validator\Constraints as Assert;

class PetBreedRequestDto
{
    #[Assert\NotNull]
    #[Assert\Type('integer')]
    public int $breedId;

    #[Assert\NotNull]
    #[Assert\Type('integer')]
    public int $petDetailId;

    public function __construct(int $breedId, int $petDetailId)
    {
        $this->breedId = $breedId;
        $this->petDetailId = $petDetailId;
    }
}