<?php

namespace App\Entity;

use App\Repository\PetDetailRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PetDetailRepository::class)]
class PetDetail
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'integer')]
    private int $age;

    #[ORM\Column(type: 'string', length: 20)]
    private string $gender;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?\DateTimeInterface $dob = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAge(): int
    {
        return $this->age;
    }

    public function setAge(int $age): self
    {
        $this->age = $age;
        return $this;
    }

    public function getGender(): string
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

    public function setDob(?\DateTimeInterface $dob): self
    {
        $this->dob = $dob;
        return $this;
    }
}