<?php

namespace App\Controller;

use App\Dto\OwnerRequestDto;
use App\Service\OwnerService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class OwnerController extends AbstractController
{
    private OwnerService $ownerService;
    private ValidatorInterface $validator;

    public function __construct(OwnerService $ownerService, ValidatorInterface $validator)
    {
        $this->ownerService = $ownerService;
        $this->validator = $validator;
    }

    // Get all owners
    #[Route('/api/owners', name: 'get_owners', methods: ['GET'])]
    public function getOwners(): JsonResponse
    {
        $owners = $this->ownerService->getAllOwners();
        return $this->json([
            'success' => true,
            'data' => $owners
        ]);
    }

    // Get an owner by id
    #[Route('/api/owners/{id}', name: 'get_owner', methods: ['GET'])]
    public function getOwner(int $id): JsonResponse
    {
        try {
            $owner = $this->ownerService->getOwner($id);
            return $this->json([
                'success' => true,
                'data' => $owner
            ]);
        } catch (\Exception $e) {
            return $this->json([
                'success' => false,
                'error' => $e->getMessage()
            ], JsonResponse::HTTP_NOT_FOUND);
        }
    }

    // Create an owner
    #[Route('/api/owners', name: 'create_owner', methods: ['POST'])]
    public function createOwner(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        if (!isset($data['name'], $data['email'])) {
            return $this->json([
                'success' => false,
                'error' => 'All fields (name, email) are required.'
            ], JsonResponse::HTTP_BAD_REQUEST);
        }

        $dto = new OwnerRequestDto($data['name'], $data['email'], $data['phone'] ?? null, $data['address'] ?? null, $data['birthdate'] ?? null);
        $errors = $this->validator->validate($dto);

        if (count($errors) > 0) {
            $errorMessages = [];
            foreach ($errors as $error) {
                $errorMessages[] = $error->getMessage();
            }

            return $this->json([
                'success' => false,
                'errors' => $errorMessages
            ], JsonResponse::HTTP_BAD_REQUEST);
        }

        try {
            $owner = $this->ownerService->createOwner($dto);
            return $this->json([
                'success' => true,
                'data' => $owner
            ], JsonResponse::HTTP_CREATED);
        } catch (\Exception $e) {
            return $this->json([
                'success' => false,
                'error' => $e->getMessage()
            ], JsonResponse::HTTP_BAD_REQUEST);
        }
    }

    // Update an owner
    #[Route('/api/owners/{id}', name: 'update_owner', methods: ['PUT'])]
    public function updateOwner(int $id, Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        if (!isset($data['name'], $data['email'])) {
            return $this->json([
                'success' => false,
                'error' => 'All fields (name, email) are required.'
            ], JsonResponse::HTTP_BAD_REQUEST);
        }

        $dto = new OwnerRequestDto($data['name'], $data['email'], $data['phone'] ?? null, $data['address'] ?? null, $data['birthdate'] ?? null);
        $errors = $this->validator->validate($dto);

        if (count($errors) > 0) {
            $errorMessages = [];
            foreach ($errors as $error) {
                $errorMessages[] = $error->getMessage();
            }

            return $this->json([
                'success' => false,
                'errors' => $errorMessages
            ], JsonResponse::HTTP_BAD_REQUEST);
        }

        try {
            $owner = $this->ownerService->updateOwner($id, $dto);
            return $this->json([
                'success' => true,
                'data' => $owner
            ]);
        } catch (\Exception $e) {
            return $this->json([
                'success' => false,
                'error' => $e->getMessage()
            ], JsonResponse::HTTP_BAD_REQUEST);
        }
    }

    // Delete an owner
    #[Route('/api/owners/{id}', name: 'delete_owner', methods: ['DELETE'])]
    public function deleteOwner(int $id): JsonResponse
    {
        try {
            $this->ownerService->deleteOwner($id);
            return $this->json([
                'success' => true,
                'message' => 'Owner deleted successfully'
            ]);
        } catch (\Exception $e) {
            return $this->json([
                'success' => false,
                'error' => $e->getMessage()
            ], JsonResponse::HTTP_BAD_REQUEST);
        }
    }
}