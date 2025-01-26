<?php

namespace App\Dto;

use Symfony\Component\Validator\Constraints as Assert;

class RegistrationRequestDto
{
    #[Assert\NotBlank]
    #[Assert\Type('string')]
    private $registration_no;

    #[Assert\NotBlank]
    #[Assert\Type('integer')]
    private $owner_id;

    #[Assert\NotBlank]
    #[Assert\Type('integer')]
    private $pet_detail_id;

    public function __construct(string $registration_no, int $owner_id, int $pet_detail_id)
    {
        $this->registration_no = $registration_no;
        $this->owner_id = $owner_id;
        $this->pet_detail_id = $pet_detail_id;
    }

    public function getRegistrationNo(): string
    {
        return $this->registration_no;
    }

    public function getOwnerId(): int
    {
        return $this->owner_id;
    }

    public function getPetDetail(): int
    {
        return $this->pet_detail_id;
    }
}