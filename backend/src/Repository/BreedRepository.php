<?php

namespace App\Repository;

use App\Entity\Breed;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Breed>
 */
class BreedRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Breed::class);
    }

    /**
     * Find breeds by pet type ID.
     *
     * @param int $petTypeId
     * @return Breed[]
     */
    public function findByPetTypeId(int $petTypeId): array
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.petType = :petTypeId')
            ->setParameter('petTypeId', $petTypeId)
            ->orderBy('b.breedName', 'ASC')
            ->getQuery()
            ->getResult();
    }

    /**
     * Find dangerous breeds.
     *
     * @return Breed[]
     */
    public function findDangerousBreeds(): array
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.isDangerous = true')
            ->orderBy('b.breedName', 'ASC')
            ->getQuery()
            ->getResult();
    }
}