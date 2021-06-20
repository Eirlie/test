<?php

namespace App\Repository;

use App\Entity\HttpLog;
use App\Service\Http\Logger\Data\HttpLogFilter;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;
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

    public function findByFiltersCount(?HttpLogFilter $filter = null): int
    {
        $query = $this->findByFiltersQB($filter)
            ->select('count(hl.id)')
        ;
        return $query->getQuery()->getResult(Query::HYDRATE_SINGLE_SCALAR);
    }

    public function findByFilters(?HttpLogFilter $filter = null): array
    {
        $query = $this->findByFiltersQB($filter)
            ->orderBy('hl.createdAt', 'DESC');
        if ($filter) {
            $itemsPerPage = $filter->getItemsPerPage();
            $query->setMaxResults($itemsPerPage);
            $query->setFirstResult(($filter->getPage() - 1) * $itemsPerPage);
        }

        return $query->getQuery()->execute();
    }

    protected function findByFiltersQB(?HttpLogFilter $filter = null): QueryBuilder
    {
        $queryBuilder = $this->createQueryBuilder('hl');
        if ($filter && $ip = $filter->getIp()) {
            $queryBuilder
                ->andWhere('hl.ip = :ip')
                ->setParameter('ip', $ip);
        }

        return $queryBuilder;
    }
}
