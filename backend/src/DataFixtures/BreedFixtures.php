<?php

namespace App\DataFixtures;

use App\Entity\Breed;
use App\Entity\PetType;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use App\DataFixtures\PetTypeFixtures;

class BreedFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $dogType = $manager->getRepository(PetType::class)->findOneBy(['type' => 'Dog']);
        $catType = $manager->getRepository(PetType::class)->findOneBy(['type' => 'Cat']);

        if (!$dogType || !$catType) {
            throw new \Exception('PetType missing in table.');
        }

        $breeds = [
            ['breedName' => 'Labrador Retriever', 'isDangerous' => false, 'petType' => $dogType],
            ['breedName' => 'German Shepherd', 'isDangerous' => true, 'petType' => $dogType],
            ['breedName' => 'Persian Cat', 'isDangerous' => false, 'petType' => $catType],
            ['breedName' => 'Siamese Cat', 'isDangerous' => false, 'petType' => $catType],
        ];

        foreach ($breeds as $data) {
            $breed = new Breed();
            $breed->setBreedName($data['breedName']);
            $breed->setIsDangerous($data['isDangerous']);
            $breed->setPetType($data['petType']);
            $manager->persist($breed);
        }

        $manager->flush();
    }

    // Make sure the petType fixtrues runs first
    public function getDependencies(): array
    {
        return [
            PetTypeFixtures::class,
        ];
    }
}
