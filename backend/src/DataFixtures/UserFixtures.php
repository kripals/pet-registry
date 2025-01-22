<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\NativePasswordHasher;

class UserFixtures extends Fixture
{
    private NativePasswordHasher $passwordHasher;

    public function __construct()
    {
        // Use Symfony's native hasher
        $this->passwordHasher = new NativePasswordHasher();
    }

    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->setEmail('test@test.com');

        // Hash password manually
        $hashedPassword = $this->passwordHasher->hash('admin123');
        $user->setPassword($hashedPassword);

        $user->setRoles(['ROLE_ADMIN']);

        $manager->persist($user);
        $manager->flush();
    }
}