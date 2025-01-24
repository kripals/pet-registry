<?php

namespace App\Dto;

use Symfony\Component\Validator\Constraints as Assert;

class PetTypeRequestDto
{
    #[Assert\NotBlank]
    #[Assert\Length(max: 50)]
    public string $type;

    public function __construct(string $type)
    {
        $this->type = $type;
    }
}