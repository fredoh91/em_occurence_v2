<?php

namespace App\Repository;

use App\Entity\EmDenomV2;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method EmDenomV2|null find($id, $lockMode = null, $lockVersion = null)
 * @method EmDenomV2|null findOneBy(array $criteria, array $orderBy = null)
 * @method EmDenomV2[]    findAll()
 * @method EmDenomV2[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EmDenomV2Repository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EmDenomV2::class);
    }

    // /**
    //  * @return EmDenomV2[] Returns an array of EmDenomV2 objects
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
    public function findOneBySomeField($value): ?EmDenomV2
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
