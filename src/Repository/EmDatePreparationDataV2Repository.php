<?php

namespace App\Repository;

use App\Entity\EmDatePreparationDataV2;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method EmDatePreparationDataV2|null find($id, $lockMode = null, $lockVersion = null)
 * @method EmDatePreparationDataV2|null findOneBy(array $criteria, array $orderBy = null)
 * @method EmDatePreparationDataV2[]    findAll()
 * @method EmDatePreparationDataV2[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EmDatePreparationDataV2Repository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EmDatePreparationDataV2::class);
    }
    public function findLast()
    {
        return $this->createQueryBuilder('e')
            ->orderBy('e.DatePreparationData', 'DESC')
            ->setMaxResults(1)
            ->getQuery()
            ->getResult()
        ;
    }
    
    // /**
    //  * @return EmDatePreparationDataV2[] Returns an array of EmDatePreparationDataV2 objects
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
    public function findOneBySomeField($value): ?EmDatePreparationDataV2
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
