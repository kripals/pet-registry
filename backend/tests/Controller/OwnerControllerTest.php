<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class OwnerControllerTest extends WebTestCase
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

    public function testGetOwners(): void
    {
        $token = $this->getJwtToken();
        $this->client->request('GET', '/api/owners', [], [], ['HTTP_AUTHORIZATION' => 'Bearer ' . $token]);

        self::assertResponseIsSuccessful();
        self::assertJson($this->client->getResponse()->getContent());
    }

    public function testGetOwner(): void
    {
        $token = $this->getJwtToken();
        $this->client->request('GET', '/api/owners/1', [], [], ['HTTP_AUTHORIZATION' => 'Bearer ' . $token]);

        self::assertResponseIsSuccessful();
        self::assertJson($this->client->getResponse()->getContent());
    }

    public function testCreateOwner(): void
    {
        $token = $this->getJwtToken();
        $this->client->request('POST', '/api/owners', [], [], ['CONTENT_TYPE' => 'application/json', 'HTTP_AUTHORIZATION' => 'Bearer ' . $token], json_encode([
            'firstName' => 'John',
            'lastName' => 'Doe',
            'email' => 'john.doe@example.com',
            'phoneNo' => '1234567890',
            'address' => '123 Main St'
        ]));

        self::assertResponseStatusCodeSame(201);
        self::assertJson($this->client->getResponse()->getContent());
    }

    public function testUpdateOwner(): void
    {
        $token = $this->getJwtToken();
        $this->client->request('PUT', '/api/owners/1', [], [], ['CONTENT_TYPE' => 'application/json', 'HTTP_AUTHORIZATION' => 'Bearer ' . $token], json_encode([
            'firstName' => 'Jane',
            'lastName' => 'Doe',
            'email' => 'jane.doe@example.com',
            'phoneNo' => '0987654321',
            'address' => '456 Main St'
        ]));

        self::assertResponseIsSuccessful();
        self::assertJson($this->client->getResponse()->getContent());
    }

    public function testDeleteOwner(): void
    {
        $token = $this->getJwtToken();
        $this->client->request('DELETE', '/api/owners/1', [], [], ['HTTP_AUTHORIZATION' => 'Bearer ' . $token]);

        self::assertResponseIsSuccessful();
    }
}
