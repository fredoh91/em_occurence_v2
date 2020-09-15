<?php

namespace App\Repository;

use App\Entity\EmDenomMapCategoV2;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method EmDenomMapCategoV2|null find($id, $lockMode = null, $lockVersion = null)
 * @method EmDenomMapCategoV2|null findOneBy(array $criteria, array $orderBy = null)
 * @method EmDenomMapCategoV2[]    findAll()
 * @method EmDenomMapCategoV2[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EmDenomMapCategoV2Repository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EmDenomMapCategoV2::class);
    }

    // /**
    //  * @return EmDenomMapCategoV2[] Returns an array of EmDenomMapCategoV2 objects
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
    public function findOneBySomeField($value): ?EmDenomMapCategoV2
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
