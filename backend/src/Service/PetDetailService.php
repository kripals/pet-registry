<?php

namespace App\Service;

use App\Entity\PetDetail;
use App\Dto\PetDetailRequestDto;
use App\Dto\PetDetailResponseDto;
use Doctrine\ORM\EntityManagerInterface;

class PetDetailService
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function createPetDetail(PetDetailRequestDto $dto): PetDetailResponseDto
    {
        $petDetail = new PetDetail();
        $petDetail->setName($dto->name);
        $petDetail->setAge($dto->age);
        $petDetail->setGender($dto->gender);
        $petDetail->setDob($dto->dob ? new \DateTime($dto->dob) : null);

        $this->entityManager->persist($petDetail);
        $this->entityManager->flush();

        return new PetDetailResponseDto($petDetail->getName(), $petDetail->getId(), $petDetail->getAge(), $petDetail->getGender(), $dto->dob);
    }

    public function getPetDetails(): array
    {
        $petDetails = $this->entityManager->getRepository(PetDetail::class)->findAll();

        return array_map(
            fn(PetDetail $petDetail) => new PetDetailResponseDto(
                $petDetail->getId(),
                $petDetail->getName(),
                $petDetail->getAge(),
                $petDetail->getGender(),
                $petDetail->getDob()?->format('Y-m-d')
            ),
            $petDetails
        );
    }

    public function getPetDetail(int $id): PetDetailResponseDto
    {
        $petDetail = $this->entityManager->getRepository(PetDetail::class)->find($id);

        if (!$petDetail) {
            throw new \Exception('Pet detail not found');
        }

        return new PetDetailResponseDto(
            $petDetail->getId(),
            $petDetail->getName(),
            $petDetail->getAge(),
            $petDetail->getGender(),
            $petDetail->getDob()?->format('Y-m-d')
        );
    }
    
    public function updatePetDetail(int $id, PetDetailRequestDto $dto): PetDetailResponseDto
    {
        $petDetail = $this->entityManager->getRepository(PetDetail::class)->find($id);

        if (!$petDetail) {
            throw new \Exception('Pet detail not found');
        }

        $petDetail->setName($dto->name);
        $petDetail->setAge($dto->age);
        $petDetail->setGender($dto->gender);
        $petDetail->setDob($dto->dob ? new \DateTime($dto->dob) : null);

        $this->entityManager->flush();

        return new PetDetailResponseDto(
            $petDetail->getId(),
            $petDetail->getName(),
            $petDetail->getAge(),
            $petDetail->getGender(),
            $petDetail->getDob()?->format('Y-m-d')
        );
    }

    public function deletePetDetail(int $id): void
    {
        $petDetail = $this->entityManager->getRepository(PetDetail::class)->find($id);

        if (!$petDetail) {
            throw new \Exception('Pet detail not found');
        }

        $this->entityManager->remove($petDetail);
        $this->entityManager->flush();
    }
}