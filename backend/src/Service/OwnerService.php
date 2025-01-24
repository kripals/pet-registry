<?php

namespace App\Service;

use App\Entity\Owner;
use App\Dto\OwnerRequestDto;
use App\Dto\OwnerResponseDto;
use Doctrine\ORM\EntityManagerInterface;

class OwnerService
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function createOwner(OwnerRequestDto $dto): OwnerResponseDto
    {
        $owner = new Owner();
        $owner->setFirstName($dto->firstName)
            ->setLastName($dto->lastName)
            ->setEmail($dto->email)
            ->setPhoneNo($dto->phoneNo)
            ->setAddress($dto->address);

        $this->entityManager->persist($owner);
        $this->entityManager->flush();

        return new OwnerResponseDto($owner->getId(), $dto->firstName, $dto->lastName, $dto->email, $dto->phoneNo, $dto->address);
    }

    public function getOwners(): array
    {
        $owners = $this->entityManager->getRepository(Owner::class)->findAll();

        return array_map(
            fn(Owner $owner) => new OwnerResponseDto(
                $owner->getId(),
                $owner->getFirstName(),
                $owner->getLastName(),
                $owner->getEmail(),
                $owner->getPhoneNo(),
                $owner->getAddress()
            ),
            $owners
        );
    }

    public function getOwner(int $id): OwnerResponseDto
    {
        $owner = $this->entityManager->getRepository(Owner::class)->find($id);

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

    public function updateOwner(int $id, OwnerRequestDto $dto): OwnerResponseDto
    {
        $owner = $this->entityManager->getRepository(Owner::class)->find($id);

        if (!$owner) {
            throw new \Exception('Owner not found');
        }

        $owner->setFirstName($dto->firstName)
            ->setLastName($dto->lastName)
            ->setEmail($dto->email)
            ->setPhoneNo($dto->phoneNo)
            ->setAddress($dto->address);

        $this->entityManager->flush();

        return new OwnerResponseDto($owner->getId(), $dto->firstName, $dto->lastName, $dto->email, $dto->phoneNo, $dto->address);
    }

    public function deleteOwner(int $id): void
    {
        $owner = $this->entityManager->getRepository(Owner::class)->find($id);

        if (!$owner) {
            throw new \Exception('Owner not found');
        }

        $this->entityManager->remove($owner);
        $this->entityManager->flush();
    }
}