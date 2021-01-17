<?php

namespace App\Repository;

use App\Entity\FindBar;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method FindBar|null find($id, $lockMode = null, $lockVersion = null)
 * @method FindBar|null findOneBy(array $criteria, array $orderBy = null)
 * @method FindBar[]    findAll()
 * @method FindBar[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FindBarRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FindBar::class);
    }

    // /**
    //  * @return FindBar[] Returns an array of FindBar objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?FindBar
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
