<?php

namespace App\Service;

use App\Dto\PetDetailRequestDto;
use App\Dto\PetDetailResponseDto;
use App\Entity\PetDetail;
use App\Repository\PetDetailRepository;
use Doctrine\ORM\EntityManagerInterface;

class PetDetailService
{
    private PetDetailRepository $petDetailRepository;
    private EntityManagerInterface $entityManager;

    public function __construct(PetDetailRepository $petDetailRepository, EntityManagerInterface $entityManager)
    {
        $this->petDetailRepository = $petDetailRepository;
        $this->entityManager = $entityManager;
    }

    public function getPetDetails(): array
    {
        $petDetails = $this->petDetailRepository->findAll();
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

    public function getPetDetail(int $id): ?PetDetailResponseDto
    {
        $petDetail = $this->petDetailRepository->find($id);
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

    public function createPetDetail(PetDetailRequestDto $dto): PetDetailResponseDto
    {
        $petDetail = new PetDetail();
        $petDetail->setName($dto->getName());
        $petDetail->setAge($dto->getAge());
        $petDetail->setGender($dto->getGender());
        $petDetail->setDob(new \DateTime($dto->getDob()));

        $this->entityManager->persist($petDetail);
        $this->entityManager->flush();

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
        $petDetail = $this->petDetailRepository->find($id);
        if (!$petDetail) {
            throw new \Exception('Pet detail not found');
        }

        $petDetail->setName($dto->getName());
        $petDetail->setAge($dto->getAge());
        $petDetail->setGender($dto->getGender());
        $petDetail->setDob(new \DateTime($dto->getDob()));

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
        $petDetail = $this->petDetailRepository->find($id);
        if (!$petDetail) {
            throw new \Exception('Pet detail not found');
        }

        $this->entityManager->remove($petDetail);
        $this->entityManager->flush();
    }
}