<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class RegistrationControllerTest extends WebTestCase
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

    public function testGetRegistrations(): void
    {
        $token = $this->getJwtToken();
        $this->client->request('GET', '/api/registrations', [], [], ['HTTP_AUTHORIZATION' => 'Bearer ' . $token]);

        self::assertResponseIsSuccessful();
        self::assertJson($this->client->getResponse()->getContent());
    }

    public function testCreateRegistration(): void
    {
        $token = $this->getJwtToken();
        $this->client->request('POST', '/api/registrations', [], [], ['CONTENT_TYPE' => 'application/json', 'HTTP_AUTHORIZATION' => 'Bearer ' . $token], json_encode([
            'registrationNo' => 'REG123',
            'petDetailId' => 1,
            'ownerId' => 1
        ]));

        self::assertResponseStatusCodeSame(201);
        self::assertJson($this->client->getResponse()->getContent());
    }

    public function testDeleteRegistration(): void
    {
        $token = $this->getJwtToken();
        $this->client->request('DELETE', '/api/registrations/1', [], [], ['HTTP_AUTHORIZATION' => 'Bearer ' . $token]);

        self::assertResponseIsSuccessful();
    }
}
