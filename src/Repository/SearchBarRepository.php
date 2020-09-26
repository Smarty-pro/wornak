<?php

namespace App\Repository;

use App\Entity\SearchBar;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SearchBar|null find($id, $lockMode = null, $lockVersion = null)
 * @method SearchBar|null findOneBy(array $criteria, array $orderBy = null)
 * @method SearchBar[]    findAll()
 * @method SearchBar[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SearchBarRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SearchBar::class);
    }

    // /**
    //  * @return SearchBar[] Returns an array of SearchBar objects
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
    public function findOneBySomeField($value): ?SearchBar
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
