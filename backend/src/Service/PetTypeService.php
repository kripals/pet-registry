<?php

namespace App\Service;

use App\Entity\PetType;
use App\Dto\PetTypeRequestDto;
use App\Dto\PetTypeResponseDto;
use Doctrine\ORM\EntityManagerInterface;

class PetTypeService
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function createPetType(PetTypeRequestDto $dto): PetTypeResponseDto
    {
        $petType = new PetType();
        $petType->setType($dto->type);

        $this->entityManager->persist($petType);
        $this->entityManager->flush();

        return new PetTypeResponseDto($petType->getId(), $petType->getType());
    }

    public function getAllPetTypes(): array
    {
        $petTypes = $this->entityManager->getRepository(PetType::class)->findAll();

        return array_map(
            fn(PetType $petType) => new PetTypeResponseDto($petType->getId(), $petType->getType()),
            $petTypes
        );
    }

    public function getPetType(int $id): PetTypeResponseDto
    {
        $petType = $this->entityManager->getRepository(PetType::class)->find($id);

        if (!$petType) {
            throw new \Exception('Pet type not found');
        }

        return new PetTypeResponseDto($petType->getId(), $petType->getType());
    }
}