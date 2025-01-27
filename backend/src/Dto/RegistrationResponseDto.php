<?php

namespace App\Dto;

class RegistrationResponseDto
{
    public int $id;
    public int $petDetailId;
    public int $ownerId;
    public string $registrationNo;

    public function __construct(int $id, int $petDetailId, int $ownerId, string $registrationNo)
    {
        $this->id = $id;
        $this->petDetailId = $petDetailId;
        $this->ownerId = $ownerId;
        $this->registrationNo = $registrationNo;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getPetDetailId(): int
    {
        return $this->petDetailId;
    }

    public function getOwnerId(): int
    {
        return $this->ownerId;
    }

    public function getRegistrationNo(): string
    {
        return $this->registrationNo;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function setPetDetailId(int $petDetailId): void
    {
        $this->petDetailId = $petDetailId;
    }

    public function setOwnerId(int $ownerId): void
    {
        $this->ownerId = $ownerId;
    }

    public function setRegistrationNo(string $registrationNo): void
    {
        $this->registrationNo = $registrationNo;
    }
}