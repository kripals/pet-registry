<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\RegistrationRepository;
use App\Entity\Registration;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\PetDetail;
use App\Entity\Owner;
use App\Dto\RegistrationDto;

final class RegistrationController extends AbstractController
{
    #[Route('/registration', name: 'app_registration')]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/RegistrationController.php',
        ]);
    }

    #[Route('/api/registrations', name: 'get_registrations', methods: ['GET'])]
    public function getRegistrations(RegistrationRepository $registrationRepository): JsonResponse
    {
        $registrations = $registrationRepository->findAll();
        $response = [];

        foreach ($registrations as $registration) {
            $response[] = new RegistrationDto(
                $registration->getId(),
                $registration->getRegistrationNo(),
                $registration->getPetDetail()->getId(),
                $registration->getOwner()->getId()
            );
        }

        return $this->json($response, JsonResponse::HTTP_OK);
    }

    #[Route('/api/registrations', name: 'create_registration', methods: ['POST'])]
    public function createRegistration(Request $request, EntityManagerInterface $entityManager): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $registration = new Registration();
        $registration->setRegistrationNo($data['registrationNo']);
        // Assuming you have methods to get the PetDetail and Owner entities by their IDs
        $petDetail = $entityManager->getRepository(PetDetail::class)->find($data['petDetailId']);
        $owner = $entityManager->getRepository(Owner::class)->find($data['ownerId']);
        $registration->setPetDetail($petDetail);
        $registration->setOwner($owner);

        $entityManager->persist($registration);
        $entityManager->flush();

        return $this->json(new RegistrationDto(
            $registration->getId(),
            $registration->getRegistrationNo(),
            $registration->getPetDetail()->getId(),
            $registration->getOwner()->getId()
        ), JsonResponse::HTTP_CREATED);
    }

    #[Route('/api/registrations/{id}', name: 'delete_registration', methods: ['DELETE'])]
    public function deleteRegistration(int $id, RegistrationRepository $registrationRepository, EntityManagerInterface $entityManager): JsonResponse
    {
        $registration = $registrationRepository->find($id);

        if (!$registration) {
            return $this->json(['message' => 'Registration not found'], JsonResponse::HTTP_NOT_FOUND);
        }

        $entityManager->remove($registration);
        $entityManager->flush();

        return $this->json(['message' => 'Registration deleted successfully'], JsonResponse::HTTP_OK);
    }
}
