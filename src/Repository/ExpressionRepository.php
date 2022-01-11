<?php

namespace App\Repository;

use App\Entity\Expression;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Expression|null find($id, $lockMode = null, $lockVersion = null)
 * @method Expression|null findOneBy(array $criteria, array $orderBy = null)
 * @method Expression[]    findAll()
 * @method Expression[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ExpressionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Expression::class);
    }


    //CONSULTA NECESARIA
    // SELECT name, GROUP_CONCAT(DISTINCT translation SEPARATOR ', '), COUNT(*) as num_busquedas FROM `expression` GROUP BY name ORDER BY num_busquedas DESC;


    // /**
    //  * @return Expression[] Returns an array of Expression objects
    //  */
    public function findAllExamplesOrderedBySearches()
    {
        $rsm = new ResultSetMapping();

        return $this->getEntityManager()
            ->getConnection()
            ->executeQuery("
                SELECT name, 
                    GROUP_CONCAT(DISTINCT translation SEPARATOR '<br>• ') as translation, 
                    COUNT(*) as searches 
                FROM expression 
                GROUP BY name 
                ORDER BY searches DESC
            ")->fetchAllAssociative();
    }


    // /**
    //  * @return Expression[] Returns an array of Expression objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Expression
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
