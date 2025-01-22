<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<User>
 */
class UserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    /**
     * Find a user by email.
     */
    public function findOneByEmail(string $email): ?User
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.email = :email')
            ->setParameter('email', $email)
            ->getQuery()
            ->getOneOrNullResult();
    }

    /**
     * Save a user entity.
     */
    public function save(User $user, bool $flush = true): void
    {
        $this->_em->persist($user);

        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * Delete a user entity.
     */
    public function delete(User $user, bool $flush = true): void
    {
        $this->_em->remove($user);

        if ($flush) {
            $this->_em->flush();
        }
    }
}
