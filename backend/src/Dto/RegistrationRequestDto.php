<?php

namespace App\Dto;

use Symfony\Component\Validator\Constraints as Assert;

class RegistrationRequestDto
{
    #[Assert\NotBlank]
    #[Assert\Type('string')]
    private $registrationNo;

    #[Assert\NotBlank]
    #[Assert\Type('integer')]
    private int $petDetailId;

    #[Assert\NotBlank]
    #[Assert\Type('integer')]
    private int $ownerId;

    public function __construct(string $registrationNo, int $petDetailId, int $ownerId)
    {
        $this->registrationNo = $registrationNo;
        $this->petDetailId = $petDetailId;
        $this->ownerId = $ownerId;
    }

    public function getRegistrationNo(): string
    {
        return $this->registrationNo;
    }

    public function getPetDetailId(): int
    {
        return $this->petDetailId;
    }

    public function getOwnerId(): int
    {
        return $this->ownerId;
    }
}