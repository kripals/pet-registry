<?php

namespace App\Service;

use App\Dto\RegistrationRequestDto;
use App\Dto\RegistrationResponseDto;
use App\Entity\Registration;
use App\Repository\PetDetailRepository;
use App\Repository\OwnerRepository;
use App\Repository\RegistrationRepository;
use Doctrine\ORM\EntityManagerInterface;

class RegistrationService
{
    private RegistrationRepository $registrationRepository;
    private PetDetailRepository $petDetailRepository;
    private OwnerRepository $ownerRepository;
    private EntityManagerInterface $entityManager;

    public function __construct(
        RegistrationRepository $registrationRepository,
        PetDetailRepository $petDetailRepository,
        OwnerRepository $ownerRepository,
        EntityManagerInterface $entityManager
    ) {
        $this->registrationRepository = $registrationRepository;
        $this->petDetailRepository = $petDetailRepository;
        $this->ownerRepository = $ownerRepository;
        $this->entityManager = $entityManager;
    }

    // Create a registration
    public function createRegistration(RegistrationRequestDto $dto): RegistrationResponseDto
    {
        $petDetail = $this->petDetailRepository->find($dto->getPetDetailId());
        $owner = $this->ownerRepository->find($dto->getOwnerId());

        if (!$petDetail || !$owner) {
            throw new \Exception('Invalid pet detail or owner ID');
        }

        $registration = new Registration();
        $registration->setPetDetail($petDetail);
        $registration->setOwner($owner);
        $registration->setRegistrationNo($dto->getRegistrationNo());

        $this->entityManager->persist($registration);
        $this->entityManager->flush();

        return new RegistrationResponseDto(
            $registration->getId(),
            $registration->getPetDetail()->getId(),
            $registration->getOwner()->getId(),
            $registration->getRegistrationNo()
        );
    }

    // Update a registration
    public function updateRegistration(int $id, RegistrationRequestDto $dto): RegistrationResponseDto
    {
        $registration = $this->registrationRepository->find($id);

        if (!$registration) {
            throw new \Exception('Registration not found');
        }

        $petDetail = $this->petDetailRepository->find($dto->getPetDetailId());
        $owner = $this->ownerRepository->find($dto->getOwnerId());

        if (!$petDetail || !$owner) {
            throw new \Exception('Pet detail or owner not found');
        }

        $registration->setPetDetail($petDetail);
        $registration->setOwner($owner);
        $registration->setRegistrationNo($dto->getRegistrationNo());

        $this->entityManager->flush();

        return new RegistrationResponseDto(
            $registration->getId(),
            $registration->getPetDetail()->getId(),
            $registration->getOwner()->getId(),
            $registration->getRegistrationNo()
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
        $registration = $this->registrationRepository->find($id);

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

    // Get detailed registration information
    public function getRegistrationDetails(int $id): array
    {
        $registration = $this->registrationRepository->find($id);

        if (!$registration) {
            throw new \Exception('Registration not found');
        }

        $petDetail = $registration->getPetDetail();
        $owner = $registration->getOwner();
        $breeds = $petDetail->getPetDetailBreeds()->map(fn($breed) => $breed->getBreedName())->toArray();

        return [
            'registration' => new RegistrationResponseDto(
                $registration->getId(),
                $registration->getPetDetail()->getId(),
                $registration->getOwner()->getId(),
                $registration->getRegistrationNo()
            ),
            'petDetail' => [
                'id' => $petDetail->getId(),
                'name' => $petDetail->getName(),
                'age' => $petDetail->getAge(),
                'gender' => $petDetail->getGender(),
                'dob' => $petDetail->getDob()?->format('Y-m-d'),
                'breeds' => $breeds
            ],
            'owner' => [
                'id' => $owner->getId(),
                'name' => $owner->getFullName(),
                'email' => $owner->getEmail()
            ]
        ];
    }

    // Delete a registration
    public function deleteRegistration(int $id): void
    {
        $registration = $this->registrationRepository->find($id);

        if (!$registration) {
            throw new \Exception('Registration not found');
        }

        $this->entityManager->remove($registration);
        $this->entityManager->flush();
    }
}