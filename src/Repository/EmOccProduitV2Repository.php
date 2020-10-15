<?php

namespace App\Repository;

use App\Entity\EmOccProduitV2;
use App\Entity\GrilleOccEmV2;
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
    public function findLike($prod): array {
            $query = $this->getEntityManager()
                    ->createQuery("
                    SELECT p FROM App\Entity\EmOccProduitV2 p
                    WHERE p.produit LIKE :prod "
            );
            $query->setParameter('prod', '%' . $prod . '%');
            dump($query->getResult());
            return $query->getResult();
        }
    /**git 
     * 
     * @param type $key
     * @return array
     */
    public function findLikeQB($prod): array {
        return $this->createQueryBuilder('p')
            ->andWhere('p.produit LIKE :prod')
            ->setParameter('prod', '%'.$prod.'%')
            ->orderBy('p.produit', 'ASC')
            ->getQuery()
            ->getResult()
            ;
        }
    /**
     * 
     * @param type $key
     * @return array
     */
    public function findLikeQBjoin($prod): array {
        $result = $this->createQueryBuilder('p')
                ->select('p', 'gr')
                ->leftJoin('App\Entity\GrilleOccEmV2', 'gr', 'WITH', 'p.Nbr >= gr.vmin AND p.Nbr <= gr.vmax')
//                ->leftJoin('App\Entity\GrilleOccEmV2', 'gr', 'WITH', 'p.Nbr >= gr.vmin')
                ->where('p.produit LIKE :prod')
                ->setParameter('prod', '%'.$prod.'%')
//                ->orderBy('p.Nbr', 'DESC')
                ->orderBy('p.produit', 'ASC')
                ->getQuery()
                ->getResult()
                ;
        dd($result);
        return $result;
        }
    /**
     * 
     * @param type $key
     * @return array
     */
    public function findLikeQBjoin_v2($prod): array {
//        $result = $this->createQueryBuilder('p')
//                ->select('p', 'gr')
//                ->leftJoin('App\Entity\GrilleOccEmV2', 'gr', 'WITH', 'p.Nbr >= gr.vmin AND p.Nbr <= gr.vmax')
////                ->leftJoin('App\Entity\GrilleOccEmV2', 'gr', 'WITH', 'p.Nbr >= gr.vmin')
//                ->where('p.produit LIKE :prod')
//                ->setParameter('prod', '%'.$prod.'%')
////                ->orderBy('p.Nbr', 'DESC')
//                ->orderBy('p.produit', 'ASC')
//                ->getQuery()
//                ->getResult()
//                ;
        

          $result = $this->createQueryBuilder('p')
//            ->leftJoin('App\Entity\GrilleOccEmV2', 'gr', 'WITH', 'p.cat_grille_id = gr.id')
            ->leftJoin('p.CatGrille', 'gr')
            ->addSelect('gr')
            ->where('p.produit LIKE :prod')
            ->setParameter('prod', '%'.$prod.'%')
            ->orderBy('p.produit', 'ASC')
            ->getQuery()
            ->getResult()
             ;
          
          
          
//        dd($result);
        return $result;
        }

    /**
     * 
     * @param type $key
     * @return type
     */
    public function findLikeJoin($prod): array {
            $query = $this->getEntityManager()
                    ->createQuery("
                    SELECT p, gr FROM App\Entity\EmOccProduitV2 p JOIN App\Entity\GrilleOccEmV2 gr WITH p.Nbr >= gr.vmin AND p.Nbr <= gr.vmax
                    WHERE p.produit LIKE :prod
                    ORDER BY p.produit ASC"
            );

            
            $query->setParameter('prod', '%' . $prod . '%');
            dump($query->getResult());
            return $query->getResult();
        }        
        
    public function findLikeJoinSQL($prod): array
    {
//        $rawSql = "SELECT m.id, (SELECT COUNT(i.id) FROM item AS i WHERE i.myclass_id = m.id) AS total FROM myclass AS m";
        $rawSql = "SELECT *
                    FROM em_occ_produit_v2 p, grille_occ_em_v2 gr 
                    WHERE p.produit LIKE '%" . $prod . "%' 
                        AND p.nbr >= gr.vmin 
                        AND p.nbr <= gr.vmax 
                        ORDER BY p.produit";
        $stmt = $this->getEntityManager()->getConnection()->prepare($rawSql);
        $stmt->execute([]);

        return $stmt->fetchAll();
    }        
     /**
     * 
     * @param type $key
     * @return array
     */
    public function findByTypGrill($TypGrill): array {
        if ($TypGrill==1) {
            $vmin = 1;
            $vmax = 3;
        }
        elseif ($TypGrill==2) {
            $vmin = 4;
            $vmax = 10;
        }
        elseif ($TypGrill==3) {
            $vmin = 11;
            $vmax = 24;            
        }
        elseif ($TypGrill==4) {
            $vmin = 25;
            $vmax = 1000;            
        }

        return $this->createQueryBuilder('p')
            ->Where('p.Nbr >= :vmin')
            ->andWhere('p.Nbr <= :vmax')
            ->setParameter('vmin', $vmin)
            ->setParameter('vmax', $vmax)
            ->orderBy('p.produit', 'ASC')
            ->getQuery()
            ->getResult()
            ;
        }       
     /**
     * 
     * @param type $key
     * @return array
     */
    public function findByTypGrillTable($TypGrill): array {
        if ($TypGrill==1) {
            $vmin = 1;
            $vmax = 3;
        }
        elseif ($TypGrill==2) {
            $vmin = 4;
            $vmax = 10;
        }
        elseif ($TypGrill==3) {
            $vmin = 11;
            $vmax = 24;            
        }
        elseif ($TypGrill==4) {
            $vmin = 25;
            $vmax = 1000;            
        }

        return $this->createQueryBuilder('p')
            ->Where('p.Nbr >= :vmin')
            ->andWhere('p.Nbr <= :vmax')
            ->setParameter('vmin', $vmin)
            ->setParameter('vmax', $vmax)
            ->orderBy('p.produit', 'ASC')
            ->getQuery()
            ->getResult()
            ;
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
