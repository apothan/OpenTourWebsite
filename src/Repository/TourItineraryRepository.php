<?php

namespace App\Repository;

use App\Entity\TourItinerary;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TourItinerary|null find($id, $lockMode = null, $lockVersion = null)
 * @method TourItinerary|null findOneBy(array $criteria, array $orderBy = null)
 * @method TourItinerary[]    findAll()
 * @method TourItinerary[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TourItineraryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TourItinerary::class);
    }

    // /**
    //  * @return TourItinerary[] Returns an array of TourItinerary objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TourItinerary
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
