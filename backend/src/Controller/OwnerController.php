<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\OwnerRepository;
use App\Entity\Owner;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Dto\OwnerDto;

final class OwnerController extends AbstractController
{
    #[Route('/owner', name: 'app_owner')]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/OwnerController.php',
        ]);
    }

    #[Route('/api/owners', name: 'get_owners', methods: ['GET'])]
    public function getOwners(OwnerRepository $ownerRepository): JsonResponse
    {
        $owners = $ownerRepository->findAll();
        $response = array_map(fn($owner) => $owner->toDto(), $owners);

        return $this->json($response, JsonResponse::HTTP_OK);
    }

    #[Route('/api/owners/{id}', name: 'get_owner', methods: ['GET'])]
    public function getOwner(int $id, OwnerRepository $ownerRepository): JsonResponse
    {
        $owner = $ownerRepository->find($id);

        if (!$owner) {
            return $this->json(['message' => 'Owner not found'], JsonResponse::HTTP_NOT_FOUND);
        }

        return $this->json($owner->toDto(), JsonResponse::HTTP_OK);
    }

    #[Route('/api/owners', name: 'create_owner', methods: ['POST'])]
    public function createOwner(Request $request, EntityManagerInterface $entityManager): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $owner = new Owner();
        $owner->setFirstName($data['firstName']);
        $owner->setLastName($data['lastName']);
        $owner->setEmail($data['email']);
        $owner->setPhoneNo($data['phoneNo']);
        $owner->setAddress($data['address']);

        $entityManager->persist($owner);
        $entityManager->flush();

        return $this->json($owner->toDto(), JsonResponse::HTTP_CREATED);
    }

    #[Route('/api/owners/{id}', name: 'update_owner', methods: ['PUT'])]
    public function updateOwner(int $id, Request $request, OwnerRepository $ownerRepository, EntityManagerInterface $entityManager): JsonResponse
    {
        $owner = $ownerRepository->find($id);

        if (!$owner) {
            return $this->json(['message' => 'Owner not found'], JsonResponse::HTTP_NOT_FOUND);
        }

        $data = json_decode($request->getContent(), true);

        $owner->setFirstName($data['firstName']);
        $owner->setLastName($data['lastName']);
        $owner->setEmail($data['email']);
        $owner->setPhoneNo($data['phoneNo']);
        $owner->setAddress($data['address']);

        $entityManager->flush();

        return $this->json($owner->toDto(), JsonResponse::HTTP_OK);
    }

    #[Route('/api/owners/{id}', name: 'delete_owner', methods: ['DELETE'])]
    public function deleteOwner(int $id, OwnerRepository $ownerRepository, EntityManagerInterface $entityManager): JsonResponse
    {
        $owner = $ownerRepository->find($id);

        if (!$owner) {
            return $this->json(['message' => 'Owner not found'], JsonResponse::HTTP_NOT_FOUND);
        }

        $entityManager->remove($owner);
        $entityManager->flush();

        return $this->json(['message' => 'Owner deleted successfully'], JsonResponse::HTTP_OK);
    }
}
