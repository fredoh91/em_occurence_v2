<?php

namespace App\Repository;

use App\Entity\EmOccDenoV2;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method EmOccDenoV2|null find($id, $lockMode = null, $lockVersion = null)
 * @method EmOccDenoV2|null findOneBy(array $criteria, array $orderBy = null)
 * @method EmOccDenoV2[]    findAll()
 * @method EmOccDenoV2[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EmOccDenoV2Repository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EmOccDenoV2::class);
    }

    // /**
    //  * @return EmOccDenoV2[] Returns an array of EmOccDenoV2 objects
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
    public function findOneBySomeField($value): ?EmOccDenoV2
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
