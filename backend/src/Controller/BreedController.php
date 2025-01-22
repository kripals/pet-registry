<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\BreedRepository;
use App\Entity\Breed;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\PetType;
use App\DTO\BreedDTO;

final class BreedController extends AbstractController
{
    private function transformToDTO(Breed $breed): BreedDTO
    {
        return new BreedDTO(
            $breed->getId(),
            $breed->getBreedName(),
            $breed->getIsDangerous(),
            $breed->getPetType()->getType()
        );
    }

    #[Route('/api/breeds', name: 'get_breeds', methods: ['GET'])]
    public function getBreeds(Request $request, BreedRepository $breedRepository): JsonResponse
    {
        try {
            // Not required fields
            $petType = $request->query->get('petType');
            $isDangerous = $request->query->get('isDangerous');

            // Convert isDangerous to a boolean if provided
            $isDangerous = $isDangerous !== null ? filter_var($isDangerous, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE) : null;

            // Fetch breeds with optional filters
            $breeds = $breedRepository->findBreeds($petType, $isDangerous);

            // Check if breeds were found
            if (empty($breeds)) {
                return $this->json(['message' => 'No breeds found'], JsonResponse::HTTP_NOT_FOUND);
            }

            // Format response
            $response = array_map([$this, 'transformToDTO'], $breeds);

            return $this->json($response, JsonResponse::HTTP_OK);
        } catch (\Exception $e) {
            return $this->json(['message' => 'An error occurred', 'error' => $e->getMessage()], JsonResponse::HTTP_BAD_REQUEST);
        }
    }

    #[Route('/api/breeds/{id}', name: 'get_breed', methods: ['GET'])]
    public function getBreed(int $id, BreedRepository $breedRepository): JsonResponse
    {
        try {
            $breed = $breedRepository->find($id);

            if (!$breed) {
                return $this->json(['message' => 'Breed not found'], JsonResponse::HTTP_NOT_FOUND);
            }

            $response = $this->transformToDTO($breed);

            return $this->json($response, JsonResponse::HTTP_OK);
        } catch (\Exception $e) {
            return $this->json(['message' => 'An error occurred', 'error' => $e->getMessage()], JsonResponse::HTTP_BAD_REQUEST);
        }
    }

    #[Route('/api/breeds', name: 'create_breed', methods: ['POST'])]
    public function createBreed(Request $request, EntityManagerInterface $entityManager): JsonResponse
    {
        try {
            $data = json_decode($request->getContent(), true);

            $breed = new Breed();
            $breed->setBreedName($data['breedName']);
            $breed->setIsDangerous($data['isDangerous']);
            // Assuming you have a method to get the PetType entity by its ID
            $petType = $entityManager->getRepository(PetType::class)->find($data['petTypeId']);
            $breed->setPetType($petType);

            $entityManager->persist($breed);
            $entityManager->flush();

            return $this->json($this->transformToDTO($breed), JsonResponse::HTTP_CREATED);
        } catch (\Exception $e) {
            return $this->json(['message' => 'An error occurred', 'error' => $e->getMessage()], JsonResponse::HTTP_BAD_REQUEST);
        }
    }

    #[Route('/api/breeds/{id}', name: 'update_breed', methods: ['PUT'])]
    public function updateBreed(int $id, Request $request, BreedRepository $breedRepository, EntityManagerInterface $entityManager): JsonResponse
    {
        try {
            $breed = $breedRepository->find($id);

            if (!$breed) {
                return $this->json(['message' => 'Breed not found'], JsonResponse::HTTP_NOT_FOUND);
            }

            $data = json_decode($request->getContent(), true);

            $breed->setBreedName($data['breedName']);
            $breed->setIsDangerous($data['isDangerous']);
            // Assuming you have a method to get the PetType entity by its ID
            $petType = $entityManager->getRepository(PetType::class)->find($data['petTypeId']);
            $breed->setPetType($petType);

            $entityManager->flush();

            return $this->json($this->transformToDTO($breed), JsonResponse::HTTP_OK);
        } catch (\Exception $e) {
            return $this->json(['message' => 'An error occurred', 'error' => $e->getMessage()], JsonResponse::HTTP_BAD_REQUEST);
        }
    }

    #[Route('/api/breeds/{id}', name: 'delete_breed', methods: ['DELETE'])]
    public function deleteBreed(int $id, BreedRepository $breedRepository, EntityManagerInterface $entityManager): JsonResponse
    {
        try {
            $breed = $breedRepository->find($id);

            if (!$breed) {
                return $this->json(['message' => 'Breed not found'], JsonResponse::HTTP_NOT_FOUND);
            }

            $entityManager->remove($breed);
            $entityManager->flush();

            return $this->json(['message' => 'Breed deleted successfully'], JsonResponse::HTTP_OK);
        } catch (\Exception $e) {
            return $this->json(['message' => 'An error occurred', 'error' => $e->getMessage()], JsonResponse::HTTP_BAD_REQUEST);
        }
    }
}
