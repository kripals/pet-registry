<?php

namespace App\Service;

use App\Dto\OwnerRequestDto;
use App\Dto\OwnerResponseDto;
use App\Entity\Owner;
use App\Repository\OwnerRepository;
use Doctrine\ORM\EntityManagerInterface;

class OwnerService
{
    private OwnerRepository $ownerRepository;
    private EntityManagerInterface $entityManager;

    public function __construct(OwnerRepository $ownerRepository, EntityManagerInterface $entityManager)
    {
        $this->ownerRepository = $ownerRepository;
        $this->entityManager = $entityManager;
    }

    public function getAllOwners(): array
    {
        $owners = $this->ownerRepository->findAll();
        $response = [];
        foreach ($owners as $owner) {
            $response[] = new OwnerResponseDto(
                $owner->getId(),
                $owner->getFirstName(),
                $owner->getLastName(),
                $owner->getEmail(),
                $owner->getPhoneNo(),
                $owner->getAddress()
            );
        }

        return $response;
    }

    public function getOwner(int $id): OwnerResponseDto
    {
        $owner = $this->ownerRepository->find($id);
        if (!$owner) {
            throw new \Exception('Owner not found');
        }

        return new OwnerResponseDto(
            $owner->getId(),
            $owner->getFirstName(),
            $owner->getLastName(),
            $owner->getEmail(),
            $owner->getPhoneNo(),
            $owner->getAddress()
        );
    }

    public function createOwner(OwnerRequestDto $dto): OwnerResponseDto
    {
        $owner = new Owner();
        $owner->setFirstName($dto->firstName);
        $owner->setLastName($dto->lastName);
        $owner->setEmail($dto->email);
        $owner->setPhoneNo($dto->phoneNo);
        $owner->setAddress($dto->address);

        $this->entityManager->persist($owner);
        $this->entityManager->flush();

        return new OwnerResponseDto(
            $owner->getId(),
            $owner->getFirstName(),
            $owner->getLastName(),
            $owner->getEmail(),
            $owner->getPhoneNo(),
            $owner->getAddress()
        );
    }

    public function updateOwner(int $id, OwnerRequestDto $dto): OwnerResponseDto
    {
        $owner = $this->ownerRepository->find($id);
        if (!$owner) {
            throw new \Exception('Owner not found');
        }

        $owner->setFirstName($dto->firstName);
        $owner->setLastName($dto->lastName);
        $owner->setEmail($dto->email);
        $owner->setPhoneNo($dto->phoneNo);
        $owner->setAddress($dto->address);

        $this->entityManager->flush();

        return new OwnerResponseDto(
            $owner->getId(),
            $owner->getFirstName(),
            $owner->getLastName(),
            $owner->getEmail(),
            $owner->getPhoneNo(),
            $owner->getAddress()
        );
    }

    public function deleteOwner(int $id): void
    {
        $owner = $this->ownerRepository->find($id);
        if (!$owner) {
            throw new \Exception('Owner not found');
        }

        $this->entityManager->remove($owner);
        $this->entityManager->flush();
    }
}