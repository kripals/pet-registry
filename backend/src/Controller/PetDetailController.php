<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\PetDetailRepository;
use App\Entity\PetDetail;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Breed;
use App\DTO\PetDetailDTO;

final class PetDetailController extends AbstractController
{
    #[Route('/pet/detail', name: 'app_pet_detail')]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/PetDetailController.php',
        ]);
    }

    #[Route('/api/pets', name: 'get_pets', methods: ['GET'])]
    public function getPets(PetDetailRepository $petDetailRepository): JsonResponse
    {
        $pets = $petDetailRepository->findAll();
        $response = [];

        foreach ($pets as $pet) {
            $response[] = new PetDetailDTO(
                $pet->getId(),
                $pet->getName(),
                $pet->getAge(),
                $pet->getBreed()->getBreedName(),
                $pet->getOwnerName()
            );
        }

        return $this->json($response, JsonResponse::HTTP_OK);
    }

    #[Route('/api/pets/{id}', name: 'get_pet', methods: ['GET'])]
    public function getPet(int $id, PetDetailRepository $petDetailRepository): JsonResponse
    {
        $pet = $petDetailRepository->find($id);

        if (!$pet) {
            return $this->json(['message' => 'Pet not found'], JsonResponse::HTTP_NOT_FOUND);
        }

        $response = new PetDetailDTO(
            $pet->getId(),
            $pet->getName(),
            $pet->getAge(),
            $pet->getBreed()->getBreedName(),
            $pet->getOwnerName()
        );

        return $this->json($response, JsonResponse::HTTP_OK);
    }

    #[Route('/api/pets', name: 'create_pet', methods: ['POST'])]
    public function createPet(Request $request, EntityManagerInterface $entityManager): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $pet = new PetDetail();
        $pet->setName($data['name']);
        $pet->setAge($data['age']);
        $pet->setGender($data['gender']);
        $pet->setDob(new \DateTime($data['dob']));
        // Assuming you have a method to get the Breed entity by its ID
        $breed = $entityManager->getRepository(Breed::class)->find($data['breedId']);
        $pet->setBreed($breed);

        $entityManager->persist($pet);
        $entityManager->flush();

        return $this->json(['message' => 'Pet created successfully'], JsonResponse::HTTP_CREATED);
    }

    #[Route('/api/pets/{id}', name: 'update_pet', methods: ['PUT'])]
    public function updatePet(int $id, Request $request, PetDetailRepository $petDetailRepository, EntityManagerInterface $entityManager): JsonResponse
    {
        $pet = $petDetailRepository->find($id);

        if (!$pet) {
            return $this->json(['message' => 'Pet not found'], JsonResponse::HTTP_NOT_FOUND);
        }

        $data = json_decode($request->getContent(), true);

        $pet->setName($data['name']);
        $pet->setAge($data['age']);
        $pet->setGender($data['gender']);
        $pet->setDob(new \DateTime($data['dob']));
        // Assuming you have a method to get the Breed entity by its ID
        $breed = $entityManager->getRepository(Breed::class)->find($data['breedId']);
        $pet->setBreed($breed);

        $entityManager->flush();

        return $this->json(['message' => 'Pet updated successfully'], JsonResponse::HTTP_OK);
    }

    #[Route('/api/pets/{id}', name: 'delete_pet', methods: ['DELETE'])]
    public function deletePet(int $id, PetDetailRepository $petDetailRepository, EntityManagerInterface $entityManager): JsonResponse
    {
        $pet = $petDetailRepository->find($id);

        if (!$pet) {
            return $this->json(['message' => 'Pet not found'], JsonResponse::HTTP_NOT_FOUND);
        }

        $entityManager->remove($pet);
        $entityManager->flush();

        return $this->json(['message' => 'Pet deleted successfully'], JsonResponse::HTTP_OK);
    }
}
