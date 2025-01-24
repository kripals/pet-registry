<?php

namespace App\Dto;

class PetDetailResponseDto
{
    public int $id;
    public int $age;
    public string $gender;
    public ?string $dob;

    public function __construct(int $id, int $age, string $gender, ?string $dob)
    {
        $this->id = $id;
        $this->age = $age;
        $this->gender = $gender;
        $this->dob = $dob;
    }
}