<?php

namespace App\Repository;

use App\Entity\Owner;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Owner>
 */
class OwnerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Owner::class);
    }

    /**
     * Find owners by email.
     *
     * @param string $email
     * @return Owner|null
     */
    public function findByEmail(string $email): ?Owner
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.email = :email')
            ->setParameter('email', $email)
            ->getQuery()
            ->getOneOrNullResult();
    }

    /**
     * Search for owners by name (first or last).
     *
     * @param string $name
     * @return Owner[]
     */
    public function findByName(string $name): array
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.firstName LIKE :name OR o.lastName LIKE :name')
            ->setParameter('name', '%' . $name . '%')
            ->orderBy('o.lastName', 'ASC')
            ->getQuery()
            ->getResult();
    }

    /**
     * Find all owners ordered by last name.
     *
     * @return Owner[]
     */
    public function findAllOrderedByLastName(): array
    {
        return $this->createQueryBuilder('o')
            ->orderBy('o.lastName', 'ASC')
            ->getQuery()
            ->getResult();
    }

    /**
     * Find owners by phone number.
     *
     * @param string $phoneNo
     * @return Owner|null
     */
    public function findByPhoneNo(string $phoneNo): ?Owner
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.phoneNo = :phoneNo')
            ->setParameter('phoneNo', $phoneNo)
            ->getQuery()
            ->getOneOrNullResult();
    }
}