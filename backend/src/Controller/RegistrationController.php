<?php

namespace App\Controller;

use App\Dto\RegistrationRequestDto;
use App\Service\RegistrationService;
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
    public function createRegistration(Request $request): JsonResponse
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
            $registration = $this->registrationService->createRegistration($dto);
            return $this->json(['success' => true, 'data' => $registration], JsonResponse::HTTP_CREATED);
        } catch (\Exception $e) {
            return $this->json(['success' => false, 'error' => $e->getMessage()], JsonResponse::HTTP_BAD_REQUEST);
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