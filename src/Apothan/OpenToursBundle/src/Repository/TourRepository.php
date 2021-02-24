<?php

namespace Apothan\OpenToursBundle\Repository;

use Apothan\OpenToursBundle\Entity\Tour;
use \Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Tour|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tour|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tour[]    findAll()
 * @method Tour[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TourRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tour::class);
    }

    public function getThree()
    {
        return $this->createQueryBuilder('c')
            ->setMaxResults(3)
            ->getQuery()
            ->getResult()
        ;
        /*
        return $this->createQueryBuilder('c')
            ->orderBy('c.pricetendaypct', 'DESC')
            ->setMaxResults(6)
            ->getQuery()
            ->getResult()
        ;
        */
    }
}
