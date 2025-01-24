<?php

namespace App\Dto;

class PetTypeResponseDto
{
    public int $id;
    public string $type;

    public function __construct(int $id, string $type)
    {
        $this->id = $id;
        $this->type = $type;
    }
}