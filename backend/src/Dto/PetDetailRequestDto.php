<?php

namespace App\Dto;

use Symfony\Component\Validator\Constraints as Assert;

class PetDetailRequestDto
{
    #[Assert\NotBlank]
    #[Assert\Type('string')]
    private $name;

    #[Assert\NotBlank]
    #[Assert\Type('float')]
    private $age;

    #[Assert\NotBlank]
    #[Assert\Choice(choices: ['male', 'female'], message: 'Choose a valid gender.')]
    private $gender;

    #[Assert\NotBlank]
    #[Assert\Date]
    private $dob;

    public function __construct(string $name, float $age, string $gender, string $dob)
    {
        $this->name = $name;
        $this->age = $age;
        $this->gender = $gender;
        $this->dob = $dob;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getAge(): float
    {
        return $this->age;
    }

    public function getGender(): string
    {
        return $this->gender;
    }

    public function getDob(): string
    {
        return $this->dob;
    }
}