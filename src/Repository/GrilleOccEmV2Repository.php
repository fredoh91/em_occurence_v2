<?php

namespace App\Repository;

use App\Entity\GrilleOccEmV2;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method GrilleOccEmV2|null find($id, $lockMode = null, $lockVersion = null)
 * @method GrilleOccEmV2|null findOneBy(array $criteria, array $orderBy = null)
 * @method GrilleOccEmV2[]    findAll()
 * @method GrilleOccEmV2[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GrilleOccEmV2Repository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GrilleOccEmV2::class);
    }

    // /**
    //  * @return GrilleOccEmV2[] Returns an array of GrilleOccEmV2 objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('g.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?GrilleOccEmV2
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
