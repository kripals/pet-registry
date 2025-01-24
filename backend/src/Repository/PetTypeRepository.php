<?php

namespace App\Repository;

use App\Entity\PetType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PetType|null find($id, $lockMode = null, $lockVersion = null)
 * @method PetType|null findOneBy(array $criteria, array $orderBy = null)
 * @method PetType[]    findAll()
 * @method PetType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PetTypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PetType::class);
    }
}