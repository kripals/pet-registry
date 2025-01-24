<?php

namespace App\Controller;

use App\Dto\BreedRequestDto;
use App\Dto\BreedResponseDto;
use App\Service\BreedService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

final class BreedController extends AbstractController
{
    private BreedService $breedService;
    private ValidatorInterface $validator;

    public function __construct(BreedService $breedService, ValidatorInterface $validator)
    {
        $this->breedService = $breedService;
        $this->validator = $validator;
    }

    // Get all breeds
    #[Route('/api/breeds', name: 'get_breeds', methods: ['GET'])]
    public function getBreeds(): JsonResponse
    {
        $breeds = $this->breedService->getAllBreeds();
        return $this->json([
            'success' => true,
            'data' => $breeds
        ]);
    }

    // Get a breed by id
    #[Route('/api/breeds/{id}', name: 'get_breed', methods: ['GET'])]
    public function getBreed(int $id): JsonResponse
    {
        try {
            $breed = $this->breedService->getBreed($id);
            return $this->json([
                'success' => true,
                'data' => $breed
            ]);
        } catch (\Exception $e) {
            return $this->json([
                'success' => false,
                'error' => $e->getMessage()
            ], JsonResponse::HTTP_NOT_FOUND);
        }
    }

    // Create a breed
    #[Route('/api/breeds', name: 'create_breed', methods: ['POST'])]
    public function createBreed(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        // Validate input data
        if (!isset($data['breed_name'], $data['is_dangerous'], $data['pet_type_id'])) {
            return $this->json([
                'success' => false,
                'error' => 'All fields (breed_name, is_dangerous, pet_type_id) are required.'
            ], JsonResponse::HTTP_BAD_REQUEST);
        }

        $dto = new BreedRequestDto($data['breed_name'], $data['is_dangerous'], $data['pet_type_id']);
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
            $breed = $this->breedService->createBreed($dto);
            return $this->json([
                'success' => true,
                'data' => $breed
            ], JsonResponse::HTTP_CREATED);
        } catch (\Exception $e) {
            return $this->json([
                'success' => false,
                'error' => $e->getMessage()
            ], JsonResponse::HTTP_BAD_REQUEST);
        }
    }

    // Update a breed
    #[Route('/api/breeds/{id}', name: 'update_breed', methods: ['PUT'])]
    public function updateBreed(int $id, Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        if (!isset($data['breed_name'], $data['is_dangerous'], $data['pet_type_id'])) {
            return $this->json([
                'success' => false,
                'error' => 'All fields (breed_name, is_dangerous, pet_type_id) are required.'
            ], JsonResponse::HTTP_BAD_REQUEST);
        }

        $dto = new BreedRequestDto($data['breed_name'], $data['is_dangerous'], $data['pet_type_id']);
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
            $breed = $this->breedService->updateBreed($id, $dto);
            return $this->json([
                'success' => true,
                'data' => $breed
            ]);
        } catch (\Exception $e) {
            return $this->json([
                'success' => false,
                'error' => $e->getMessage()
            ], JsonResponse::HTTP_BAD_REQUEST);
        }
    }

    // Delete a breed
    #[Route('/api/breeds/{id}', name: 'delete_breed', methods: ['DELETE'])]
    public function deleteBreed(int $id): JsonResponse
    {
        try {
            $this->breedService->deleteBreed($id);
            return $this->json([
                'success' => true,
                'message' => 'Breed deleted successfully'
            ]);
        } catch (\Exception $e) {
            return $this->json([
                'success' => false,
                'error' => $e->getMessage()
            ], JsonResponse::HTTP_BAD_REQUEST);
        }
    }
}