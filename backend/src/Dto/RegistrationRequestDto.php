<?php

namespace App\Dto;

use Symfony\Component\Validator\Constraints as Assert;

class RegistrationRequestDto
{
    #[Assert\NotNull]
    #[Assert\Type('integer')]
    public int $petDetailId;

    #[Assert\NotNull]
    #[Assert\Type('integer')]
    public int $ownerId;

    #[Assert\NotBlank]
    #[Assert\Length(max: 50)]
    public string $registrationNo;

    public function __construct(int $petDetailId, int $ownerId, string $registrationNo)
    {
        $this->petDetailId = $petDetailId;
        $this->ownerId = $ownerId;
        $this->registrationNo = $registrationNo;
    }
}