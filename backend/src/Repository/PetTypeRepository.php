<?php

namespace App\Repository;

use App\Entity\PetType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PetType>
 */
class PetTypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PetType::class);
    }

    /**
     * Find PetType by type name.
     *
     * @param string $type
     * @return PetType|null
     */
    public function findByType(string $type): ?PetType
    {
        return $this->createQueryBuilder('pt')
            ->andWhere('pt.type = :type')
            ->setParameter('type', $type)
            ->getQuery()
            ->getOneOrNullResult();
    }

    /**
     * Get all PetTypes ordered by name.
     *
     * @return PetType[]
     */
    public function findAllOrderedByName(): array
    {
        return $this->createQueryBuilder('pt')
            ->orderBy('pt.type', 'ASC')
            ->getQuery()
            ->getResult();
    }

    /**
     * Search PetTypes by partial name match.
     *
     * @param string $searchTerm
     * @return PetType[]
     */
    public function searchByPartialType(string $searchTerm): array
    {
        return $this->createQueryBuilder('pt')
            ->andWhere('pt.type LIKE :searchTerm')
            ->setParameter('searchTerm', '%' . $searchTerm . '%')
            ->orderBy('pt.type', 'ASC')
            ->getQuery()
            ->getResult();
    }
}