<?php

namespace App\Repository;

use App\Entity\PetDetail;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PetDetail>
 */
class PetDetailRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PetDetail::class);
    }

    /**
     * Find PetDetails by age.
     *
     * @param int $age
     * @return PetDetail[]
     */
    public function findByAge(int $age): array
    {
        return $this->createQueryBuilder('pd')
            ->andWhere('pd.age = :age')
            ->setParameter('age', $age)
            ->orderBy('pd.id', 'ASC')
            ->getQuery()
            ->getResult();
    }

    /**
     * Find PetDetails by gender.
     *
     * @param string $gender
     * @return PetDetail[]
     */
    public function findByGender(string $gender): array
    {
        return $this->createQueryBuilder('pd')
            ->andWhere('pd.gender = :gender')
            ->setParameter('gender', $gender)
            ->orderBy('pd.id', 'ASC')
            ->getQuery()
            ->getResult();
    }

    /**
     * Find PetDetails born before a specific date.
     *
     * @param \DateTimeInterface $date
     * @return PetDetail[]
     */
    public function findBornBefore(\DateTimeInterface $date): array
    {
        return $this->createQueryBuilder('pd')
            ->andWhere('pd.dob < :date')
            ->setParameter('date', $date)
            ->orderBy('pd.dob', 'ASC')
            ->getQuery()
            ->getResult();
    }

    /**
     * Find PetDetails by a combination of age and gender.
     *
     * @param int $age
     * @param string $gender
     * @return PetDetail[]
     */
    public function findByAgeAndGender(int $age, string $gender): array
    {
        return $this->createQueryBuilder('pd')
            ->andWhere('pd.age = :age')
            ->andWhere('pd.gender = :gender')
            ->setParameter('age', $age)
            ->setParameter('gender', $gender)
            ->orderBy('pd.id', 'ASC')
            ->getQuery()
            ->getResult();
    }
}