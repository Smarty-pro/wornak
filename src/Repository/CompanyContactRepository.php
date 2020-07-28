<?php

namespace App\Repository;

use App\Entity\CompanyContact;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CompanyContact|null find($id, $lockMode = null, $lockVersion = null)
 * @method CompanyContact|null findOneBy(array $criteria, array $orderBy = null)
 * @method CompanyContact[]    findAll()
 * @method CompanyContact[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CompanyContactRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CompanyContact::class);
    }

    // /**
    //  * @return CompanyContact[] Returns an array of CompanyContact objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CompanyContact
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
