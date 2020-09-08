<?php

namespace App\Repository;

use App\Entity\EmRomediV2;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method EmRomediV2|null find($id, $lockMode = null, $lockVersion = null)
 * @method EmRomediV2|null findOneBy(array $criteria, array $orderBy = null)
 * @method EmRomediV2[]    findAll()
 * @method EmRomediV2[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EmRomediV2Repository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EmRomediV2::class);
    }
        
     /**
      * @return Query
      */

    public function findByProduitQuery($prod): Query
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.BN_Label_Romedi LIKE :BN_Label')
            ->setParameter('BN_Label', '%'.$prod.'%')
            ->orderBy('r.BN_Label_Romedi', 'ASC')
            ->getQuery()
        ;
    }
        
     /**
      * @return EmRomediV2[] Returns an array of EmRomediV2 objects
      */

    public function findByProduit($prod): array
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.BN_Label_Romedi LIKE :BN_Label')
            ->setParameter('BN_Label', '%'.$prod.'%')
            ->orderBy('r.BN_Label_Romedi', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

        
    // /**
    //  * @return EmRomediV2[] Returns an array of EmRomediV2 objects
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
    public function findOneBySomeField($value): ?EmRomediV2
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
