<?php

namespace App\Dto;

class RegistrationDTO
{
    private ?int $id;
    private ?string $registrationNo;
    private ?int $petDetailId;
    private ?int $ownerId;

    public function __construct(?int $id, ?string $registrationNo, ?int $petDetailId, ?int $ownerId)
    {
        $this->id = $id;
        $this->registrationNo = $registrationNo;
        $this->petDetailId = $petDetailId;
        $this->ownerId = $ownerId;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRegistrationNo(): ?string
    {
        return $this->registrationNo;
    }

    public function getPetDetailId(): ?int
    {
        return $this->petDetailId;
    }

    public function getOwnerId(): ?int
    {
        return $this->ownerId;
    }
}
