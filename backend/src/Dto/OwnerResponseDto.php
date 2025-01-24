<?php

namespace App\Dto;

class OwnerResponseDto
{
    public int $id;
    public string $firstName;
    public string $lastName;
    public string $email;
    public string $phoneNo;
    public ?string $address;

    public function __construct(int $id, string $firstName, string $lastName, string $email, string $phoneNo, ?string $address)
    {
        $this->id = $id;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->phoneNo = $phoneNo;
        $this->address = $address;
    }
}