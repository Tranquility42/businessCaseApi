<?php

namespace App\Repository;

use App\Entity\Carcategory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Carcategory|null find($id, $lockMode = null, $lockVersion = null)
 * @method Carcategory|null findOneBy(array $criteria, array $orderBy = null)
 * @method Carcategory[]    findAll()
 * @method Carcategory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CarcategoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Carcategory::class);
    }

    // /**
    //  * @return Carcategory[] Returns an array of Carcategory objects
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
    public function findOneBySomeField($value): ?Carcategory
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
