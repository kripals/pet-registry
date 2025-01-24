<?php

namespace App\Service;

use App\Entity\PetBreed;
use App\Dto\PetBreedRequestDto;
use App\Dto\PetBreedResponseDto;
use App\Entity\Breed;
use App\Entity\PetDetail;
use Doctrine\ORM\EntityManagerInterface;

class PetBreedService
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function createPetBreeds(int $petDetailId, array $breeds): array
    {
        $petDetail = $this->entityManager->getRepository(PetDetail::class)->find($petDetailId);

        if (!$petDetail) {
            throw new \Exception('Invalid pet detail ID');
        }

        // Delete all existing PetBreed entries for the given pet detail
        $existingPetBreeds = $this->entityManager->getRepository(PetBreed::class)->findBy(['petDetail' => $petDetail]);
        foreach ($existingPetBreeds as $existingPetBreed) {
            $this->entityManager->remove($existingPetBreed);
        }
        $this->entityManager->flush();

        $responseDtos = [];

        // Create new PetBreed entries
        foreach ($breeds as $breedData) {
            $breed = $this->entityManager->getRepository(Breed::class)->find($breedData['breed_id']);

            if (!$breed) {
                throw new \Exception('Invalid breed ID');
            }

            $petBreed = new PetBreed();
            $petBreed->setBreed($breed);
            $petBreed->setPetDetail($petDetail);

            $this->entityManager->persist($petBreed);
            $this->entityManager->flush();

            $responseDtos[] = new PetBreedResponseDto($petBreed->getId(), $breedData['breed_id'], $petDetailId);
        }

        return $responseDtos;
    }

    public function getPetBreeds(): array
    {
        $petBreeds = $this->entityManager->getRepository(PetBreed::class)->findAll();

        return array_map(
            fn(PetBreed $petBreed) => new PetBreedResponseDto(
                $petBreed->getId(),
                $petBreed->getBreed()->getId(),
                $petBreed->getPetDetail()->getId()
            ),
            $petBreeds
        );
    }

    public function getPetBreed(int $id): PetBreedResponseDto
    {
        $petBreed = $this->entityManager->getRepository(PetBreed::class)->find($id);

        if (!$petBreed) {
            throw new \Exception('Pet breed not found');
        }

        return new PetBreedResponseDto(
            $petBreed->getId(),
            $petBreed->getBreed()->getId(),
            $petBreed->getPetDetail()->getId()
        );
    }

    public function deletePetBreed(int $id): void
    {
        $petBreed = $this->entityManager->getRepository(PetBreed::class)->find($id);

        if (!$petBreed) {
            throw new \Exception('Pet breed not found');
        }

        $this->entityManager->remove($petBreed);
        $this->entityManager->flush();
    }
}