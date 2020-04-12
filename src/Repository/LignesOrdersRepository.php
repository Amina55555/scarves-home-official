<?php

namespace App\Repository;

use App\Entity\LignesOrders;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method LignesOrders|null find($id, $lockMode = null, $lockVersion = null)
 * @method LignesOrders|null findOneBy(array $criteria, array $orderBy = null)
 * @method LignesOrders[]    findAll()
 * @method LignesOrders[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LignesOrdersRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LignesOrders::class);
    }

    // /**
    //  * @return LignesOrders[] Returns an array of LignesOrders objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?LignesOrders
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
