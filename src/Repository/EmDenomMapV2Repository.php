<?php

namespace App\Repository;

use App\Entity\EmDenomMapV2;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method EmDenomMapV2|null find($id, $lockMode = null, $lockVersion = null)
 * @method EmDenomMapV2|null findOneBy(array $criteria, array $orderBy = null)
 * @method EmDenomMapV2[]    findAll()
 * @method EmDenomMapV2[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EmDenomMapV2Repository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EmDenomMapV2::class);
    }

    // /**
    //  * @return EmDenomMapV2[] Returns an array of EmDenomMapV2 objects
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
    public function findOneBySomeField($value): ?EmDenomMapV2
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
