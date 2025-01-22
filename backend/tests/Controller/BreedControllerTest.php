<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class BreedControllerTest extends WebTestCase
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

    public function testGetBreeds(): void
    {
        $token = $this->getJwtToken();
        $this->client->request('GET', '/api/breeds', [], [], ['HTTP_AUTHORIZATION' => 'Bearer ' . $token]);

        self::assertResponseIsSuccessful();
        self::assertJson($this->client->getResponse()->getContent());
    }

    public function testGetBreed(): void
    {
        $token = $this->getJwtToken();
        $this->client->request('GET', '/api/breeds/1', [], [], ['HTTP_AUTHORIZATION' => 'Bearer ' . $token]);

        self::assertResponseIsSuccessful();
        self::assertJson($this->client->getResponse()->getContent());
    }

    public function testCreateBreed(): void
    {
        $token = $this->getJwtToken();
        $this->client->request('POST', '/api/breeds', [], [], ['CONTENT_TYPE' => 'application/json', 'HTTP_AUTHORIZATION' => 'Bearer ' . $token], json_encode([
            'breedName' => 'Test Breed',
            'isDangerous' => false,
            'petTypeId' => 1
        ]));

        self::assertResponseStatusCodeSame(201);
        self::assertJson($this->client->getResponse()->getContent());
    }

    public function testUpdateBreed(): void
    {
        $token = $this->getJwtToken();
        $this->client->request('PUT', '/api/breeds/1', [], [], ['CONTENT_TYPE' => 'application/json', 'HTTP_AUTHORIZATION' => 'Bearer ' . $token], json_encode([
            'breedName' => 'Updated Breed',
            'isDangerous' => true,
            'petTypeId' => 1
        ]));

        self::assertResponseIsSuccessful();
        self::assertJson($this->client->getResponse()->getContent());
    }

    public function testDeleteBreed(): void
    {
        $token = $this->getJwtToken();
        $this->client->request('DELETE', '/api/breeds/1', [], [], ['HTTP_AUTHORIZATION' => 'Bearer ' . $token]);

        self::assertResponseIsSuccessful();
    }
}