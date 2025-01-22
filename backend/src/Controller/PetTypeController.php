<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\PetTypeRepository;
use App\Entity\PetType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\DTO\PetTypeDTO;

final class PetTypeController extends AbstractController
{
    #[Route('/pet/type', name: 'app_pet_type')]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/PetTypeController.php',
        ]);
    }

    #[Route('/api/pet-types', name: 'get_pet_types', methods: ['GET'])]
    public function getPetTypes(PetTypeRepository $petTypeRepository): JsonResponse
    {
        $petTypes = $petTypeRepository->findAll();
        $response = array_map(fn($petType) => $petType->toDTO(), $petTypes);

        return $this->json($response, JsonResponse::HTTP_OK);
    }

    #[Route('/api/pet-types', name: 'create_pet_type', methods: ['POST'])]
    public function createPetType(Request $request, EntityManagerInterface $entityManager): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $petType = new PetType();
        $petType->setName($data['name']);

        $entityManager->persist($petType);
        $entityManager->flush();

        return $this->json(['message' => 'Pet type created successfully'], JsonResponse::HTTP_CREATED);
    }

    #[Route('/api/pet-types/{id}', name: 'delete_pet_type', methods: ['DELETE'])]
    public function deletePetType(int $id, PetTypeRepository $petTypeRepository, EntityManagerInterface $entityManager): JsonResponse
    {
        $petType = $petTypeRepository->find($id);

        if (!$petType) {
            return $this->json(['message' => 'Pet type not found'], JsonResponse::HTTP_NOT_FOUND);
        }

        $entityManager->remove($petType);
        $entityManager->flush();

        return $this->json(['message' => 'Pet type deleted successfully'], JsonResponse::HTTP_OK);
    }
}
