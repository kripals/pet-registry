<?php

namespace App\Service;

use App\Entity\Registration;
use App\Dto\RegistrationRequestDto;
use App\Dto\RegistrationResponseDto;
use App\Entity\PetDetail;
use App\Entity\Owner;
use Doctrine\ORM\EntityManagerInterface;

class RegistrationService
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    // Create a registration
    public function createRegistration(RegistrationRequestDto $dto): RegistrationResponseDto
    {
        $petDetail = $this->entityManager->getRepository(PetDetail::class)->find($dto->petDetailId);
        $owner = $this->entityManager->getRepository(Owner::class)->find($dto->ownerId);

        if (!$petDetail || !$owner) {
            throw new \Exception('Invalid pet detail or owner ID');
        }

        $registration = new Registration();
        $registration->setPetDetail($petDetail)
            ->setOwner($owner)
            ->setRegistrationNo($dto->registrationNo);

        $this->entityManager->persist($registration);
        $this->entityManager->flush();

        return new RegistrationResponseDto(
            $registration->getId(),
            $dto->petDetailId,
            $dto->ownerId,
            $dto->registrationNo
        );
    }

    // Update a registration
    public function updateRegistration(int $id, RegistrationRequestDto $dto): RegistrationResponseDto
    {
        $registration = $this->entityManager->getRepository(Registration::class)->find($id);

        if (!$registration) {
            throw new \Exception('Registration not found');
        }

        $petDetail = $this->entityManager->getRepository(PetDetail::class)->find($dto->petDetailId);
        $owner = $this->entityManager->getRepository(Owner::class)->find($dto->ownerId);

        if (!$petDetail || !$owner) {
            throw new \Exception('Invalid pet detail or owner ID');
        }

        $registration->setPetDetail($petDetail)
            ->setOwner($owner)
            ->setRegistrationNo($dto->registrationNo);

        $this->entityManager->flush();

        return new RegistrationResponseDto(
            $registration->getId(),
            $dto->petDetailId,
            $dto->ownerId,
            $dto->registrationNo
        );
    }

    // Get all registrations
    public function getRegistrations(): array
    {
        $registrations = $this->entityManager->getRepository(Registration::class)->findAll();

        return array_map(
            fn(Registration $registration) => new RegistrationResponseDto(
                $registration->getId(),
                $registration->getPetDetail()->getId(),
                $registration->getOwner()->getId(),
                $registration->getRegistrationNo()
            ),
            $registrations
        );
    }

    // Get a registration by id
    public function getRegistration(int $id): RegistrationResponseDto
    {
        $registration = $this->entityManager->getRepository(Registration::class)->find($id);

        if (!$registration) {
            throw new \Exception('Registration not found');
        }

        return new RegistrationResponseDto(
            $registration->getId(),
            $registration->getPetDetail()->getId(),
            $registration->getOwner()->getId(),
            $registration->getRegistrationNo()
        );
    }

    // Delete a registration
    public function deleteRegistration(int $id): void
    {
        $registration = $this->entityManager->getRepository(Registration::class)->find($id);

        if (!$registration) {
            throw new \Exception('Registration not found');
        }

        $this->entityManager->remove($registration);
        $this->entityManager->flush();
    }
}