<?php

namespace App\Repository;

use App\Entity\EmDenomMapTodoV2;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method EmDenomMapTodoV2|null find($id, $lockMode = null, $lockVersion = null)
 * @method EmDenomMapTodoV2|null findOneBy(array $criteria, array $orderBy = null)
 * @method EmDenomMapTodoV2[]    findAll()
 * @method EmDenomMapTodoV2[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EmDenomMapTodoV2Repository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EmDenomMapTodoV2::class);
    }

    // /**
    //  * @return EmDenomMapTodoV2[] Returns an array of EmDenomMapTodoV2 objects
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
     
    
     /**
      * @return EmDenomMapTodoV2[] Returns an array of EmDenomMapTodoV2 objects
      */
    
    public function findLimitTo(int $nb_record)
    {
        return $this->createQueryBuilder('e')
            ->orderBy('e.id', 'ASC')
            ->setMaxResults($nb_record)
            ->getQuery()
            ->getResult()
        ;
    }
    

    /*
    public function findOneBySomeField($value): ?EmDenomMapTodoV2
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
