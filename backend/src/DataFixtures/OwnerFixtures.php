<?php

namespace App\DataFixtures;

use App\Entity\Owner;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class OwnerFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $owner = new Owner();
        $owner->setFirstName('Test');
        $owner->setLastName('Owner');
        $owner->setEmail('testowner@example.com');
        $owner->setPhoneNo('123-456-7890');
        $owner->setAddress('123 Test Street, Test City, Test Country');

        $manager->persist($owner);
        $manager->flush();
    }
}