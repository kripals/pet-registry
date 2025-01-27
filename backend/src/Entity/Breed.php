<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use App\Repository\BreedRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BreedRepository::class)]
class Breed
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 100)]
    private string $breedName;

    #[ORM\Column(type: 'boolean')]
    private bool $isDangerous;

    #[ORM\ManyToOne(targetEntity: PetType::class, inversedBy: 'breeds')]
    #[ORM\JoinColumn(nullable: false)]
    private PetType $petType;

    #[ORM\ManyToMany(targetEntity: "App\Entity\PetDetail", mappedBy: "petDetailBreeds")]
    private $petDetails;

    public function __construct()
    {
        $this->petDetails = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBreedName(): string
    {
        return $this->breedName;
    }

    public function setBreedName(string $breedName): self
    {
        $this->breedName = $breedName;
        return $this;
    }

    public function isDangerous(): bool
    {
        return $this->isDangerous;
    }

    public function setIsDangerous(bool $isDangerous): self
    {
        $this->isDangerous = $isDangerous;
        return $this;
    }

    public function getPetType(): PetType
    {
        return $this->petType;
    }

    public function setPetType(PetType $petType): self
    {
        $this->petType = $petType;
        return $this;
    }

    /**
     * @return Collection|PetDetail[]
     */
    public function getPetDetails(): Collection
    {
        return $this->petDetails;
    }

    public function addPetDetail(PetDetail $petDetail): self
    {
        if (!$this->petDetails->contains($petDetail)) {
            $this->petDetails[] = $petDetail;
            $petDetail->addPetDetailBreed($this);
        }

        return $this;
    }

    public function removePetDetail(PetDetail $petDetail): self
    {
        if ($this->petDetails->removeElement($petDetail)) {
            $petDetail->removePetDetailBreed($this);
        }

        return $this;
    }
}