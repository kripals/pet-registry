<?php

namespace App\Controller;

use App\Dto\PetTypeRequestDto;
use App\Service\PetTypeService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class PetTypeController extends AbstractController
{
    private PetTypeService $petTypeService;
    private ValidatorInterface $validator;

    public function __construct(PetTypeService $petTypeService, ValidatorInterface $validator)
    {
        $this->petTypeService = $petTypeService;
        $this->validator = $validator;
    }

    // Get all pet types
    #[Route('/api/pet-types', name: 'get_pet_types', methods: ['GET'])]
    public function getPetTypes(): JsonResponse
    {
        $petTypes = $this->petTypeService->getAllPetTypes();
        return $this->json([
            'success' => true,
            'data' => $petTypes
        ]);
    }

    // Get a pet type by id
    #[Route('/api/pet-types/{id}', name: 'get_pet_type', methods: ['GET'])]
    public function getPetType(int $id): JsonResponse
    {
        try {
            $petType = $this->petTypeService->getPetType($id);
            return $this->json([
                'success' => true,
                'data' => $petType
            ]);
        } catch (\Exception $e) {
            return $this->json([
                'success' => false,
                'error' => $e->getMessage()
            ], JsonResponse::HTTP_NOT_FOUND);
        }
    }

    // Create a pet type
    #[Route('/api/pet-types', name: 'create_pet_type', methods: ['POST'])]
    public function createPetType(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        // Validate input data
        if (!isset($data['type'])) {
            return $this->json([
                'success' => false,
                'error' => 'The "type" field is required.'
            ], JsonResponse::HTTP_BAD_REQUEST);
        }

        $dto = new PetTypeRequestDto($data['type']);
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
            $petType = $this->petTypeService->createPetType($dto);
            return $this->json([
                'success' => true,
                'data' => $petType
            ], JsonResponse::HTTP_CREATED);
        } catch (\Exception $e) {
            return $this->json([
                'success' => false,
                'error' => $e->getMessage()
            ], JsonResponse::HTTP_BAD_REQUEST);
        }
    }
}