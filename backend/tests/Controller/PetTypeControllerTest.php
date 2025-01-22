<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class PetTypeControllerTest extends WebTestCase
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

    public function testGetPetTypes(): void
    {
        $token = $this->getJwtToken();
        $this->client->request('GET', '/api/pet-types', [], [], ['HTTP_AUTHORIZATION' => 'Bearer ' . $token]);

        self::assertResponseIsSuccessful();
        self::assertJson($this->client->getResponse()->getContent());
    }

    public function testGetPetType(): void
    {
        $token = $this->getJwtToken();
        $this->client->request('GET', '/api/pet-types/1', [], [], ['HTTP_AUTHORIZATION' => 'Bearer ' . $token]);

        self::assertResponseIsSuccessful();
        self::assertJson($this->client->getResponse()->getContent());
    }

    public function testCreatePetType(): void
    {
        $token = $this->getJwtToken();
        $this->client->request('POST', '/api/pet-types', [], [], ['CONTENT_TYPE' => 'application/json', 'HTTP_AUTHORIZATION' => 'Bearer ' . $token], json_encode([
            'name' => 'Test Pet Type'
        ]));

        self::assertResponseStatusCodeSame(201);
        self::assertJson($this->client->getResponse()->getContent());
    }

    public function testUpdatePetType(): void
    {
        $token = $this->getJwtToken();
        $this->client->request('PUT', '/api/pet-types/1', [], [], ['CONTENT_TYPE' => 'application/json', 'HTTP_AUTHORIZATION' => 'Bearer ' . $token], json_encode([
            'name' => 'Updated Pet Type'
        ]));

        self::assertResponseIsSuccessful();
        self::assertJson($this->client->getResponse()->getContent());
    }

    public function testDeletePetType(): void
    {
        $token = $this->getJwtToken();
        $this->client->request('DELETE', '/api/pet-types/1', [], [], ['HTTP_AUTHORIZATION' => 'Bearer ' . $token]);

        self::assertResponseIsSuccessful();
    }
}
