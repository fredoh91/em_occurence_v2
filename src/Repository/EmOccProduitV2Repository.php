<?php

namespace App\Repository;

use App\Entity\EmOccProduitV2;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method EmOccProduitV2|null find($id, $lockMode = null, $lockVersion = null)
 * @method EmOccProduitV2|null findOneBy(array $criteria, array $orderBy = null)
 * @method EmOccProduitV2[]    findAll()
 * @method EmOccProduitV2[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EmOccProduitV2Repository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EmOccProduitV2::class);
    }
    /**
     * 
     * @param type $key
     * @return type
     */
    public function findLike($prod) {
            $query = $this->getEntityManager()
                    ->createQuery("
                    SELECT p FROM App\Entity\EmOccProduitV2 p
                    WHERE p.produit LIKE :prod "
            );
            $query->setParameter('prod', '%' . $prod . '%');

            return $query->getResult();
        }
    // /**
    //  * @return EmOccProduitV2[] Returns an array of EmOccProduitV2 objects
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
    public function findOneBySomeField($value): ?EmOccProduitV2
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
