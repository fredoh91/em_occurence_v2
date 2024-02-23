<?php

namespace App\Repository;

use App\Entity\EMProduitsBaseAccessV2;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<EMProduitsBaseAccessV2>
 *
 * @method EMProduitsBaseAccessV2|null find($id, $lockMode = null, $lockVersion = null)
 * @method EMProduitsBaseAccessV2|null findOneBy(array $criteria, array $orderBy = null)
 * @method EMProduitsBaseAccessV2[]    findAll()
 * @method EMProduitsBaseAccessV2[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EMProduitsBaseAccessV2Repository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EMProduitsBaseAccessV2::class);
    }

    public function DonneListe_numBNPV(string $value): string
    {
        
        $LstProd = $this->createQueryBuilder('p')
            ->andWhere('p.Denomination LIKE :val')
            ->setParameter('val', '%'.$value.'%')
            ->andWhere('p.numeroCRPV IS NOT NULL')
            ->orderBy('p.id', 'DESC')
            ->getQuery()
            ->getResult();

        foreach ($LstProd as $prod) {

            if ($prod->getNumeroCRPV() !== '') {
                if (isset($lst_numBNPV)) {
                    $lst_numBNPV .= "," . $prod->getNumeroCRPV() ;
                } else {
                    $lst_numBNPV = $prod->getNumeroCRPV() ;
                }
            }
        }
        return $lst_numBNPV;
    }


//    /**
//     * @return EMProduitsBaseAccessV2[] Returns an array of EMProduitsBaseAccessV2 objects
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

//    public function findOneBySomeField($value): ?EMProduitsBaseAccessV2
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
