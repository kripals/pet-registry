<?php

namespace App\Entity;

use App\Repository\BreedRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BreedRepository::class)]
class Breed
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: PetType::class)]
    #[ORM\JoinColumn(nullable: false)]
    private ?PetType $petType = null;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $breedName = null;

    #[ORM\Column(type: 'boolean')]
    private ?bool $isDangerous = null;

    // Getters and Setters

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPetType(): ?PetType
    {
        return $this->petType;
    }

    public function setPetType(?PetType $petType): self
    {
        $this->petType = $petType;

        return $this;
    }

    public function getBreedName(): ?string
    {
        return $this->breedName;
    }

    public function setBreedName(string $breedName): self
    {
        $this->breedName = $breedName;

        return $this;
    }

    public function isDangerous(): ?bool
    {
        return $this->isDangerous;
    }

    public function setIsDangerous(bool $isDangerous): self
    {
        $this->isDangerous = $isDangerous;

        return $this;
    }
}
