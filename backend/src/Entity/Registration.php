<?php

namespace App\Entity;

use App\Repository\RegistrationRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RegistrationRepository::class)]
class Registration
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: PetDetail::class)]
    #[ORM\JoinColumn(nullable: false)]
    private PetDetail $petDetail;

    #[ORM\ManyToOne(targetEntity: Owner::class)]
    #[ORM\JoinColumn(nullable: false)]
    private Owner $owner;

    #[ORM\Column(type: 'string', length: 50, unique: true)]
    private string $registrationNo;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPetDetail(): PetDetail
    {
        return $this->petDetail;
    }

    public function setPetDetail(PetDetail $petDetail): self
    {
        $this->petDetail = $petDetail;
        return $this;
    }

    public function getOwner(): Owner
    {
        return $this->owner;
    }

    public function setOwner(Owner $owner): self
    {
        $this->owner = $owner;
        return $this;
    }

    public function getRegistrationNo(): string
    {
        return $this->registrationNo;
    }

    public function setRegistrationNo(string $registrationNo): self
    {
        $this->registrationNo = $registrationNo;
        return $this;
    }
}