<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\BreedRepository;
use Symfony\Component\HttpFoundation\Request;

final class BreedController extends AbstractController
{
    #[Route('/api/breeds', name: 'get_breeds', methods: ['GET'])]
    public function getBreeds(Request $request, BreedRepository $breedRepository): JsonResponse
    {
        // Not required fields
        $petType = $request->query->get('petType');
        $isDangerous = $request->query->get('isDangerous');

        // Convert isDangerous to a boolean if provided
        $isDangerous = $isDangerous !== null ? filter_var($isDangerous, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE) : null;

        // Fetch breeds with optional filters
        $breeds = $breedRepository->findBreeds($petType, $isDangerous);

        // Format response
        $response = [];
        foreach ($breeds as $breed) {
            $response[] = [
                'id' => $breed->getId(),
                'breedName' => $breed->getBreedName(),
                'isDangerous' => $breed->getIsDangerous(),
                'petType' => $breed->getPetType()->getType(),
            ];
        }

        return $this->json($response);
    }
}
