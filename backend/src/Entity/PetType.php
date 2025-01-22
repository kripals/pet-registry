<?php

namespace App\Entity;

use App\Repository\PetTypeRepository;
use Doctrine\ORM\Mapping as ORM;
use App\DTO\PetTypeDTO;

#[ORM\Entity(repositoryClass: PetTypeRepository::class)]
class PetType
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 255, unique: true)]
    private ?string $type = null;

    // Getters and Setters

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function toDTO(): PetTypeDTO
    {
        return new PetTypeDTO($this->getId(), $this->getType());
    }
}