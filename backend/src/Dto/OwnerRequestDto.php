<?php

namespace App\Dto;

use Symfony\Component\Validator\Constraints as Assert;

class OwnerRequestDto
{
    #[Assert\NotBlank]
    #[Assert\Length(max: 50)]
    public string $firstName;

    #[Assert\NotBlank]
    #[Assert\Length(max: 50)]
    public string $lastName;

    #[Assert\NotBlank]
    #[Assert\Email]
    #[Assert\Length(max: 100)]
    public string $email;

    #[Assert\NotBlank]
    #[Assert\Length(max: 20)]
    public string $phoneNo;

    #[Assert\Length(max: 255)]
    public ?string $address;

    public function __construct(string $firstName, string $lastName, string $email, string $phoneNo, ?string $address)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->phoneNo = $phoneNo;
        $this->address = $address;
    }
}