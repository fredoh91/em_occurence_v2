<?php

namespace App\Repository;

use App\Entity\EmDenomLstNumBNPVV2;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<EmDenomLstNumBNPVV2>
 *
 * @method EmDenomLstNumBNPVV2|null find($id, $lockMode = null, $lockVersion = null)
 * @method EmDenomLstNumBNPVV2|null findOneBy(array $criteria, array $orderBy = null)
 * @method EmDenomLstNumBNPVV2[]    findAll()
 * @method EmDenomLstNumBNPVV2[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EmDenomLstNumBNPVV2Repository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EmDenomLstNumBNPVV2::class);
    }

//    /**
//     * @return EmDenomLstNumBNPVV2[] Returns an array of EmDenomLstNumBNPVV2 objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('e.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?EmDenomLstNumBNPVV2
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
