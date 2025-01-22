<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;
use Symfony\Component\Security\Http\Authenticator\JsonLoginAuthenticator;

class SecurityController extends AbstractController
{
    #[Route('/api/login', name: 'api_login', methods: ['POST'])]
    public function login(Request $request, UserAuthenticatorInterface $userAuthenticator, JsonLoginAuthenticator $authenticator): JsonResponse
    {
var_dump('This is the code that is run');
die();
        // Handle the login request and return a response
        $credentials = json_decode($request->getContent(), true);

        // Authenticate the user
        $user = $userAuthenticator->authenticateUser($credentials, $authenticator, $request);

        if ($user) {
            return new JsonResponse(['message' => 'Login successful'], JsonResponse::HTTP_OK);
        }

        return new JsonResponse(['message' => 'Invalid credentials'], JsonResponse::HTTP_UNAUTHORIZED);
    }
}