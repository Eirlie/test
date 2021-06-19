<?php

namespace App\Repository;

use App\Entity\HttpLog;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method HttpLog|null find($id, $lockMode = null, $lockVersion = null)
 * @method HttpLog|null findOneBy(array $criteria, array $orderBy = null)
 * @method HttpLog[]    findAll()
 * @method HttpLog[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HttpLogRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, HttpLog::class);
    }

    // /**
    //  * @return HttpLog[] Returns an array of HttpLog objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('h.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?HttpLog
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
