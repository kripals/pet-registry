<?php

namespace App\Repository;

use App\Entity\PetBreed;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PetBreed>
 */
class PetBreedRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PetBreed::class);
    }

    /**
     * Find PetBreeds by Breed ID.
     *
     * @param int $breedId
     * @return PetBreed[]
     */
    public function findByBreedId(int $breedId): array
    {
        return $this->createQueryBuilder('pb')
            ->andWhere('pb.breed = :breedId')
            ->setParameter('breedId', $breedId)
            ->orderBy('pb.id', 'ASC')
            ->getQuery()
            ->getResult();
    }

    /**
     * Find PetBreeds by PetDetail ID.
     *
     * @param int $petDetailId
     * @return PetBreed[]
     */
    public function findByPetDetailId(int $petDetailId): array
    {
        return $this->createQueryBuilder('pb')
            ->andWhere('pb.petDetail = :petDetailId')
            ->setParameter('petDetailId', $petDetailId)
            ->orderBy('pb.id', 'ASC')
            ->getQuery()
            ->getResult();
    }

    /**
     * Find a specific PetBreed by Breed ID and PetDetail ID.
     *
     * @param int $breedId
     * @param int $petDetailId
     * @return PetBreed|null
     */
    public function findByBreedAndPetDetail(int $breedId, int $petDetailId): ?PetBreed
    {
        return $this->createQueryBuilder('pb')
            ->andWhere('pb.breed = :breedId')
            ->andWhere('pb.petDetail = :petDetailId')
            ->setParameter('breedId', $breedId)
            ->setParameter('petDetailId', $petDetailId)
            ->getQuery()
            ->getOneOrNullResult();
    }
}