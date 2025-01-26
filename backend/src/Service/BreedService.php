<?php

namespace App\Service;

use App\Entity\Breed;
use App\Entity\PetType;
use App\Dto\BreedRequestDto;
use App\Dto\BreedResponseDto;
use App\Repository\BreedRepository;
use Doctrine\ORM\EntityManagerInterface;

class BreedService
{
    private EntityManagerInterface $entityManager;
    private BreedRepository $breedRepository;

    public function __construct(EntityManagerInterface $entityManager, BreedRepository $breedRepository)
    {
        $this->entityManager = $entityManager;
        $this->breedRepository = $breedRepository;
    }

    public function getAllBreeds(): array
    {
        $breeds = $this->breedRepository->findAll();
        $response = [];
        foreach ($breeds as $breed) {
            $response[] = new BreedResponseDto(
                $breed->getId(),
                $breed->getBreedName(),
                $breed->isDangerous(),
                $breed->getPetType()->getType()
            );
        }

        return $response;
    }

    public function getBreed(int $id): BreedResponseDto
    {
        $breed = $this->breedRepository->find($id);
        if (!$breed) {
            throw new \Exception('Breed not found');
        }

        return new BreedResponseDto(
            $breed->getId(),
            $breed->getBreedName(),
            $breed->isDangerous(),
            $breed->getPetType()->getType()
        );
    }

    public function getBreedsByPetType(int $petTypeId): array
    {
        $petType = $this->entityManager->getRepository(PetType::class)->find($petTypeId);
        if (!$petType) {
            throw new \Exception('Invalid pet type');
        }

        $breeds = $this->breedRepository->findBy(['petType' => $petType]);
        $response = [];
        foreach ($breeds as $breed) {
            $response[] = new BreedResponseDto(
                $breed->getId(),
                $breed->getBreedName(),
                $breed->isDangerous(),
                $petType->getType()
            );
        }

        return $response;
    }

    public function createBreed(BreedRequestDto $Dto): BreedResponseDto
    {
        $petType = $this->entityManager->getRepository(PetType::class)->find($Dto->petTypeId);
        if (!$petType) {
            throw new \Exception('Invalid pet type');
        }

        $breed = new Breed();
        $breed->setBreedName($Dto->breedName);
        $breed->setIsDangerous($Dto->isDangerous);
        $breed->setPetType($petType);

        $this->entityManager->persist($breed);
        $this->entityManager->flush();

        return new BreedResponseDto(
            $breed->getId(),
            $breed->getBreedName(),
            $breed->isDangerous(),
            $petType->getType()
        );
    }

    public function updateBreed(int $id, BreedRequestDto $Dto): BreedResponseDto
    {
        $breed = $this->breedRepository->find($id);
        if (!$breed) {
            throw new \Exception('Breed not found');
        }

        $petType = $this->entityManager->getRepository(PetType::class)->find($Dto->petTypeId);
        if (!$petType) {
            throw new \Exception('Invalid pet type');
        }

        $breed->setBreedName($Dto->breedName);
        $breed->setIsDangerous($Dto->isDangerous);
        $breed->setPetType($petType);

        $this->entityManager->flush();

        return new BreedResponseDto(
            $breed->getId(),
            $breed->getBreedName(),
            $breed->isDangerous(),
            $petType->getType()
        );
    }

    public function deleteBreed(int $id): void
    {
        $breed = $this->breedRepository->find($id);
        if (!$breed) {
            throw new \Exception('Breed not found');
        }

        $this->entityManager->remove($breed);
        $this->entityManager->flush();
    }
}