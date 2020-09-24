<?php

namespace App\Repository;

use App\Entity\SellAmount;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SellAmount|null find($id, $lockMode = null, $lockVersion = null)
 * @method SellAmount|null findOneBy(array $criteria, array $orderBy = null)
 * @method SellAmount[]    findAll()
 * @method SellAmount[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SellAmountRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SellAmount::class);
    }

    // /**
    //  * @return SellAmount[] Returns an array of SellAmount objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?SellAmount
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
