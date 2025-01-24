<?php

namespace App\Dto;

use Symfony\Component\Validator\Constraints as Assert;

class PetDetailRequestDto
{
    #[Assert\NotBlank]
    #[Assert\Type('integer')]
    #[Assert\GreaterThanOrEqual(0)]
    public int $age;

    #[Assert\NotBlank]
    #[Assert\Choice(choices: ['Male', 'Female', 'Other'], message: 'Invalid gender')]
    public string $gender;

    #[Assert\DateTime]
    public ?string $dob;

    public function __construct(int $age, string $gender, ?string $dob)
    {
        $this->age = $age;
        $this->gender = $gender;
        $this->dob = $dob;
    }
}