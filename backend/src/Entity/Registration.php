<?php

namespace App\Entity;

use App\Repository\RegistrationRepository;
use Doctrine\ORM\Mapping as ORM;
use App\Dto\RegistrationDTO;

#[ORM\Entity(repositoryClass: RegistrationRepository::class)]
class Registration
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: PetDetail::class)]
    #[ORM\JoinColumn(nullable: false)]
    private ?PetDetail $petDetail = null;

    #[ORM\ManyToOne(targetEntity: Owner::class)]
    #[ORM\JoinColumn(nullable: false)]
    private ?Owner $owner = null;

    #[ORM\Column(type: 'string', length: 255, unique: true)]
    private ?string $registrationNo = null;

    // Getters and Setters

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPetDetail(): ?PetDetail
    {
        return $this->petDetail;
    }

    public function setPetDetail(?PetDetail $petDetail): self
    {
        $this->petDetail = $petDetail;

        return $this;
    }

    public function getOwner(): ?Owner
    {
        return $this->owner;
    }

    public function setOwner(?Owner $owner): self
    {
        $this->owner = $owner;

        return $this;
    }

    public function getRegistrationNo(): ?string
    {
        return $this->registrationNo;
    }

    public function setRegistrationNo(string $registrationNo): self
    {
        $this->registrationNo = $registrationNo;

        return $this;
    }

    public function toDto(): RegistrationDTO
    {
        return new RegistrationDTO(
            $this->getId(),
            $this->getRegistrationNo(),
            $this->getPetDetail() ? $this->getPetDetail()->getId() : null,
            $this->getOwner() ? $this->getOwner()->getId() : null
        );
    }
}