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
}