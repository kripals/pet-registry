<?php

namespace App\Repository;

use App\Entity\Registration;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Registration>
 */
class RegistrationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Registration::class);
    }

    /**
     * Find a Registration by registration number.
     *
     * @param string $registrationNo
     * @return Registration|null
     */
    public function findByRegistrationNumber(string $registrationNo): ?Registration
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.registrationNo = :registrationNo')
            ->setParameter('registrationNo', $registrationNo)
            ->getQuery()
            ->getOneOrNullResult();
    }

    /**
     * Find all Registrations for a specific PetDetail.
     *
     * @param int $petDetailId
     * @return Registration[]
     */
    public function findByPetDetailId(int $petDetailId): array
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.petDetail = :petDetailId')
            ->setParameter('petDetailId', $petDetailId)
            ->orderBy('r.id', 'ASC')
            ->getQuery()
            ->getResult();
    }

    /**
     * Find all Registrations for a specific Owner.
     *
     * @param int $ownerId
     * @return Registration[]
     */
    public function findByOwnerId(int $ownerId): array
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.owner = :ownerId')
            ->setParameter('ownerId', $ownerId)
            ->orderBy('r.id', 'ASC')
            ->getQuery()
            ->getResult();
    }

    /**
     * Find all Registrations within a specific date range.
     *
     * @param \DateTimeInterface $startDate
     * @param \DateTimeInterface $endDate
     * @return Registration[]
     */
    public function findByDateRange(\DateTimeInterface $startDate, \DateTimeInterface $endDate): array
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.registeredAt BETWEEN :startDate AND :endDate')
            ->setParameter('startDate', $startDate)
            ->setParameter('endDate', $endDate)
            ->orderBy('r.registeredAt', 'ASC')
            ->getQuery()
            ->getResult();
    }
}