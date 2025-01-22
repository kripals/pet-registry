<?php

namespace App\Entity;

use App\Repository\PetDetailRepository;
use Doctrine\ORM\Mapping as ORM;
use App\DTO\PetDetailDTO;

#[ORM\Entity(repositoryClass: PetDetailRepository::class)]
class PetDetail
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: 'integer')]
    private ?int $age = null;

    #[ORM\Column(type: 'string', length: 10)]
    private ?string $gender = null;

    #[ORM\Column(type: 'date')]
    private ?\DateTimeInterface $dob = null;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $name = null;

    // Getters and Setters

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(int $age): self
    {
        $this->age = $age;

        return $this;
    }

    public function getGender(): ?string
    {
        return $this->gender;
    }

    public function setGender(string $gender): self
    {
        $this->gender = $gender;

        return $this;
    }

    public function getDob(): ?\DateTimeInterface
    {
        return $this->dob;
    }

    public function setDob(\DateTimeInterface $dob): self
    {
        $this->dob = $dob;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function toDTO(): PetDetailDTO
    {
        return new PetDetailDTO(
            $this->id,
            $this->name,
            $this->age,
            // Assuming breed and ownerName are properties of PetDetail
            $this->breed ?? '', 
            $this->ownerName ?? ''
        );
    }
}