<?php
namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use App\Repository\PetDetailRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PetDetailRepository::class)]
class PetDetail
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 255)]
    private string $name;

    #[ORM\Column(type: 'integer')]
    private int $age;

    #[ORM\Column(type: 'string', length: 20)]
    private string $gender;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?\DateTimeInterface $dob = null;

    #[ORM\ManyToMany(targetEntity: Breed::class, inversedBy: 'petDetails')]
    private Collection $petDetailBreeds;

    public function __construct()
    {
        $this->petDetailBreeds = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
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

    /**
     * @return Collection|Breed[]
     */
    public function getPetDetailBreeds(): Collection
    {
        return $this->petDetailBreeds;
    }

    public function addPetDetailBreed(Breed $breed): self
    {
        if (!$this->petDetailBreeds->contains($breed)) {
            $this->petDetailBreeds[] = $breed;
        }

        return $this;
    }

    public function removePetDetailBreed(Breed $breed): self
    {
        $this->petDetailBreeds->removeElement($breed);

        return $this;
    }
}