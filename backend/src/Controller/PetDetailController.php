<?php

namespace App\Controller;

use App\Dto\PetDetailRequestDto;
use App\Service\PetDetailService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use App\Service\PetBreedService;

class PetDetailController extends AbstractController
{
    private PetDetailService $petDetailService;
    private PetBreedService $petBreedService;
    private ValidatorInterface $validator;

    public function __construct(PetDetailService $petDetailService, PetBreedService $petBreedService, ValidatorInterface $validator)
    {
        $this->petDetailService = $petDetailService;
        $this->petBreedService = $petBreedService;
        $this->validator = $validator;
    }

    // Get all pet details
    #[Route('/api/pet-details', name: 'get_pet_details', methods: ['GET'])]
    public function getPetDetails(): JsonResponse
    {
        try {
            $petDetails = $this->petDetailService->getPetDetails();
            return $this->json([
                'success' => true,
                'data' => $petDetails
            ]);
        } catch (\Exception $e) {
            return $this->json([
                'success' => false,
                'error' => $e->getMessage()
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    
    // Get a pet detail by id
    #[Route('/api/pet-details/{id}', name: 'get_pet_detail', methods: ['GET'])]
    public function getPetDetail(int $id): JsonResponse
    {
        try {
            $petDetail = $this->petDetailService->getPetDetail($id);
            return $this->json([
                'success' => true,
                'data' => $petDetail
            ]);
        } catch (\Exception $e) {
            return $this->json([
                'success' => false,
                'error' => $e->getMessage()
            ], JsonResponse::HTTP_NOT_FOUND);
        }
    }

    // Create a pet detail
    #[Route('/api/pet-details', name: 'create_pet_detail', methods: ['POST'])]
    public function createPetDetail(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        if (!isset($data['age'], $data['gender'])) {
            return $this->json([
                'success' => false,
                'error' => 'Fields "age" and "gender" are required.'
            ], JsonResponse::HTTP_BAD_REQUEST);
        }

        $dto = new PetDetailRequestDto($data['name'], $data['age'], $data['gender'], $data['dob'] ?? null);
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
            $petDetail = $this->petDetailService->createPetDetail($dto);

            if (isset($data['breeds']) && is_array($data['breeds'])) {
                try {
                    $this->petBreedService->createPetBreeds($petDetail->getId(), $data['breeds']);
                } catch (\Exception $e) {
                return $this->json([
                    'success' => false,
                    'error' => $e->getMessage()
                ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
                }
            }

            return $this->json([
                'success' => true,
                'data' => $petDetail
            ], JsonResponse::HTTP_CREATED);
        } catch (\Exception $e) {
            return $this->json([
                'success' => false,
                'error' => $e->getMessage()
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    // Update a pet detail
    #[Route('/api/pet-details/{id}', name: 'update_pet_detail', methods: ['PUT'])]
    public function updatePetDetail(int $id, Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        if (!isset($data['age'], $data['gender'])) {
            return $this->json([
                'success' => false,
                'error' => 'Fields "age" and "gender" are required.'
            ], JsonResponse::HTTP_BAD_REQUEST);
        }

        $dto = new PetDetailRequestDto($data['name'], $data['age'], $data['gender'], $data['dob'] ?? null);
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
            $petDetail = $this->petDetailService->updatePetDetail($id, $dto);

            if (isset($data['breeds']) && is_array($data['breeds'])) {
                try {
                    $this->petBreedService->createPetBreeds($petDetail->getId(), $data['breeds']);
                } catch (\Exception $e) {
                    return $this->json([
                        'success' => false,
                        'error' => $e->getMessage()
                    ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
                }
            }
            return $this->json([
                'success' => true,
                'data' => $petDetail
            ]);
        } catch (\Exception $e) {
            return $this->json([
                'success' => false,
                'error' => $e->getMessage()
            ], JsonResponse::HTTP_NOT_FOUND);
        }
    }

    // Delete a pet detail
    #[Route('/api/pet-details/{id}', name: 'delete_pet_detail', methods: ['DELETE'])]
    public function deletePetDetail(int $id): JsonResponse
    {
        try {
            $this->petDetailService->deletePetDetail($id);
            return $this->json([
                'success' => true,
                'message' => 'Pet detail deleted successfully.'
            ]);
        } catch (\Exception $e) {
            return $this->json([
                'success' => false,
                'error' => $e->getMessage()
            ], JsonResponse::HTTP_NOT_FOUND);
        }
    }
}