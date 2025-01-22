<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class PetDetailControllerTest extends WebTestCase
{
    private KernelBrowser $client;

    protected function setUp(): void
    {
        $this->client = static::createClient();
    }

    private function getJwtToken(): string
    {
        $this->client->request('POST', '/api/login', [], [], ['CONTENT_TYPE' => 'application/json'], json_encode([
            'email' => 'test@test.com',
            'password' => 'admin123'
        ]));

        $response = $this->client->getResponse();
        $data = json_decode($response->getContent(), true);

        return $data['token'];
    }

    public function testGetPets(): void
    {
        $token = $this->getJwtToken();
        $this->client->request('GET', '/api/pets', [], [], ['HTTP_AUTHORIZATION' => 'Bearer ' . $token]);

        self::assertResponseIsSuccessful();
        self::assertJson($this->client->getResponse()->getContent());
    }

    public function testGetPet(): void
    {
        $token = $this->getJwtToken();
        $this->client->request('GET', '/api/pets/1', [], [], ['HTTP_AUTHORIZATION' => 'Bearer ' . $token]);

        self::assertResponseIsSuccessful();
        self::assertJson($this->client->getResponse()->getContent());
    }

    public function testCreatePet(): void
    {
        $token = $this->getJwtToken();
        $this->client->request('POST', '/api/pets', [], [], ['CONTENT_TYPE' => 'application/json', 'HTTP_AUTHORIZATION' => 'Bearer ' . $token], json_encode([
            'name' => 'Test Pet',
            'age' => 2,
            'breedId' => 1
        ]));

        self::assertResponseStatusCodeSame(201);
        self::assertJson($this->client->getResponse()->getContent());
    }

    public function testUpdatePet(): void
    {
        $token = $this->getJwtToken();
        $this->client->request('PUT', '/api/pets/1', [], [], ['CONTENT_TYPE' => 'application/json', 'HTTP_AUTHORIZATION' => 'Bearer ' . $token], json_encode([
            'name' => 'Updated Pet',
            'age' => 3,
            'breedId' => 1
        ]));

        self::assertResponseIsSuccessful();
        self::assertJson($this->client->getResponse()->getContent());
    }

    public function testDeletePet(): void
    {
        $token = $this->getJwtToken();
        $this->client->request('DELETE', '/api/pets/1', [], [], ['HTTP_AUTHORIZATION' => 'Bearer ' . $token]);

        self::assertResponseIsSuccessful();
    }
}
