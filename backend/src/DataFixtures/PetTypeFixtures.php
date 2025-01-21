<?php

namespace App\DataFixtures;

use App\Entity\PetType;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class PetTypeFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $petTypes = ['Dog', 'Cat'];

        foreach ($petTypes as $type) {
            $petType = new PetType();
            $petType->setType($type);
            $manager->persist($petType);

            /* 
                TODO: reference doesnt seem to be working with the breed fixtures, can be fixed
                
                // set a reference to use in other fixtures
                $this->addReference('pet_type_' . strtolower($type), $petType);
            */
        }

        $manager->flush();
    }
}
