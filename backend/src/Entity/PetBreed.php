<?php

namespace App\Entity;

use App\Repository\PetBreedRepository;
use Doctrine\ORM\Mapping as ORM;
use App\DTO\PetBreedDTO;

#[ORM\Entity(repositoryClass: PetBreedRepository::class)]
class PetBreed
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: Breed::class)]
    #[ORM\JoinColumn(nullable: false)]
    private ?Breed $breed = null;

    #[ORM\ManyToOne(targetEntity: PetDetail::class)]
    #[ORM\JoinColumn(nullable: false)]
    private ?PetDetail $petDetail = null;

    // Getters and Setters

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBreed(): ?Breed
    {
        return $this->breed;
    }

    public function setBreed(?Breed $breed): self
    {
        $this->breed = $breed;

        return $this;
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

    /**
     * Convert PetBreed entity to DTO.
     *
     * @return PetBreedDTO
     */
    public function toDTO(): PetBreedDTO
    {
        return new PetBreedDTO(
            $this->getId(),
            $this->getBreed()->getId(),
            $this->getPetDetail()->getId()
        );
    }
}