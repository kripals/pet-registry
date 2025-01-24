<?php

namespace App\Entity;

use App\Repository\PetBreedRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PetBreedRepository::class)]
class PetBreed
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: Breed::class)]
    #[ORM\JoinColumn(nullable: false)]
    private Breed $breed;

    #[ORM\ManyToOne(targetEntity: PetDetail::class)]
    #[ORM\JoinColumn(nullable: false)]
    private PetDetail $petDetail;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBreed(): Breed
    {
        return $this->breed;
    }

    public function setBreed(Breed $breed): self
    {
        $this->breed = $breed;
        return $this;
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
}