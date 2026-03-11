<?php

declare(strict_types=1);

namespace Core\Job\Repository;

use Core\App\Repository\AbstractRepository;
use Core\Job\Entity\Job;
use Doctrine\ORM\QueryBuilder;
use Dot\DependencyInjection\Attribute\Entity;

#[Entity(name: Job::class)]
class JobRepository extends AbstractRepository
{
    /**
     * @param array<non-empty-string, mixed> $params
     * @param array<non-empty-string, mixed> $filters
     */
    public function getJobs(
        array $params = [],
        array $filters = [],
    ): QueryBuilder {
        $queryBuilder = $this
            ->getQueryBuilder()
            ->select(['job'])
            ->from(Job::class, 'job');

        // add filters

        $queryBuilder
            ->orderBy($params['sort'], $params['dir'])
            ->setFirstResult($params['offset'])
            ->setMaxResults($params['limit'])
            ->groupBy('job.uuid');
        $queryBuilder->getQuery()->useQueryCache(true);

        return $queryBuilder;
    }
}
