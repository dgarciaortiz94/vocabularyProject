<?php

namespace App\Repository;

use App\Entity\UserOptions;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method UserOptions|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserOptions|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserOptions[]    findAll()
 * @method UserOptions[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserOptionsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserOptions::class);
    }

    // /**
    //  * @return UserOptions[] Returns an array of UserOptions objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?UserOptions
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
