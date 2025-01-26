<?php

namespace App\Controller;

use App\Entity\Breed;
use App\Entity\Owner;
use App\Entity\PetDetail;
use App\Entity\Registration;
use App\Dto\PetDetailRequestDto;
use App\Dto\RegistrationRequestDto;
use App\Service\RegistrationService;
use App\Utils\Utilities;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class RegistrationController extends AbstractController
{
    private RegistrationService $registrationService;
    private ValidatorInterface $validator;

    public function __construct(RegistrationService $registrationService, ValidatorInterface $validator)
    {
        $this->registrationService = $registrationService;
        $this->validator = $validator;
    }

    // Get all registrations
    #[Route('/api/registrations', name: 'get_registrations', methods: ['GET'])]
    public function getRegistrations(): JsonResponse
    {
        $registrations = $this->registrationService->getRegistrations();
        return $this->json(['success' => true, 'data' => $registrations]);
    }

    // Get a registration by id
    #[Route('/api/registrations/{id}', name: 'get_registration', methods: ['GET'])]
    public function getRegistration(int $id): JsonResponse
    {
        try {
            $registration = $this->registrationService->getRegistration($id);
            return $this->json(['success' => true, 'data' => $registration]);
        } catch (\Exception $e) {
            return $this->json(['success' => false, 'error' => $e->getMessage()], JsonResponse::HTTP_NOT_FOUND);
        }
    }

    // Create a registration
    #[Route('/api/registrations', name: 'create_registration', methods: ['POST'])]
    public function createRegistration(Request $request, EntityManagerInterface $entityManager, ValidatorInterface $validator): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        if (!$data) {
            return $this->json(['success' => false, 'error' => 'Invalid JSON'], JsonResponse::HTTP_BAD_REQUEST);
        }

        // Ensure gender is in lowercase
        $gender = strtolower($data['pet_detail']['gender']);
        if (!in_array($gender, ['male', 'female'])) {
            return $this->json(['success' => false, 'error' => 'Invalid gender'], JsonResponse::HTTP_BAD_REQUEST);
        }

        // Ensure dob is in a valid datetime format
        $dob = \DateTime::createFromFormat('Y-m-d', $data['pet_detail']['dob']);
        if (!$dob) {
            return $this->json(['success' => false, 'error' => 'This value is not a valid datetime.'], JsonResponse::HTTP_BAD_REQUEST);
        }

        $petDetailDto = new PetDetailRequestDto(
            $data['pet_detail']['name'],
            Utilities::convertDurationToYears($data['pet_detail']['age']),
            $gender,
            $data['pet_detail']['dob']
        );

        // Validate pet detail Dto
        $errors = $validator->validate($petDetailDto);
        if (count($errors) > 0) {
            $errorMessages = [];
            foreach ($errors as $error) {
                $errorMessages[] = $error->getMessage();
            }
            return $this->json(['success' => false, 'errors' => $errorMessages], JsonResponse::HTTP_BAD_REQUEST);
        }

        try {
            $petDetail = new PetDetail();
            $petDetail->setName($petDetailDto->getName());
            $petDetail->setAge($petDetailDto->getAge());
            $petDetail->setGender($petDetailDto->getGender());
            $petDetail->setDob(new \DateTime($petDetailDto->getDob()));
            $entityManager->persist($petDetail);

            // relate breeds to PetDetail
            foreach ($data['breed_id'] as $breedId) {
                $breed = $entityManager->getRepository(Breed::class)->find($breedId);
                if ($breed) {
                    $petDetail->addPetDetailBreed($breed);
                } else {
                    return $this->json(['success' => false, 'error' => 'Breed not found'], JsonResponse::HTTP_NOT_FOUND);
                }
            }
            $entityManager->flush(); // Ensure the PetDetail entity is persisted and its ID is generated

            // Generate a registration number with suffix "REG-" and current timestamp
            $registrationNumber = 'REG-' . time();
            $registrationDto = new RegistrationRequestDto(
                $registrationNumber,
                $data['owner_id'],
                $petDetail->getId()
            );
            
            // Validate registration Dto
            $errors = $validator->validate($registrationDto);
            if (count($errors) > 0) {
                $errorMessages = [];
                foreach ($errors as $error) {
                    $errorMessages[] = $error->getMessage();
                }
                return $this->json(['success' => false, 'errors' => $errorMessages], JsonResponse::HTTP_BAD_REQUEST);
            }

            $registration = new Registration();
            $registration->setPetDetail($petDetail);
            $owner = $entityManager->getRepository(Owner::class)->find($registrationDto->getOwnerId());
            if (!$owner) {
                return $this->json(['success' => false, 'error' => 'Owner not found'], JsonResponse::HTTP_NOT_FOUND);
            }
            $registration->setOwner($owner);
            $registration->setRegistrationNo($registrationDto->getRegistrationNo());
            $entityManager->persist($registration);
            $entityManager->flush();
            $entityManager->flush();

            return $this->json(['success' => true, 'message' => 'Registration successful'], JsonResponse::HTTP_CREATED);
        } catch (\Exception $e) {
            return $this->json(['success' => false, 'error' => $e->getMessage()], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    // Update a registration
    #[Route('/api/registrations/{id}', name: 'update_registration', methods: ['PUT'])]
    public function updateRegistration(int $id, Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $dto = new RegistrationRequestDto($data['petDetailId'], $data['ownerId'], $data['registrationNo']);

        $errors = $this->validator->validate($dto);
        if (count($errors) > 0) {
            $errorMessages = [];
            foreach ($errors as $error) {
                $errorMessages[] = $error->getMessage();
            }

            return $this->json(['success' => false, 'errors' => $errorMessages], JsonResponse::HTTP_BAD_REQUEST);
        }

        try {
            $registration = $this->registrationService->updateRegistration($id, $dto);
            return $this->json(['success' => true, 'data' => $registration]);
        } catch (\Exception $e) {
            return $this->json(['success' => false, 'error' => $e->getMessage()], JsonResponse::HTTP_BAD_REQUEST);
        }
    }

    // Delete a registration
    #[Route('/api/registrations/{id}', name: 'delete_registration', methods: ['DELETE'])]
    public function deleteRegistration(int $id): JsonResponse
    {
        try {
            $this->registrationService->deleteRegistration($id);
            return $this->json(['success' => true, 'message' => 'Registration deleted successfully']);
        } catch (\Exception $e) {
            return $this->json(['success' => false, 'error' => $e->getMessage()], JsonResponse::HTTP_NOT_FOUND);
        }
    }
}