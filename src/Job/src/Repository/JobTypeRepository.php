<?php

declare(strict_types=1);

namespace Core\Job\Repository;

use Core\App\Repository\AbstractRepository;
use Core\Job\Entity\JobType;
use Doctrine\ORM\QueryBuilder;
use Dot\DependencyInjection\Attribute\Entity;

#[Entity(name: JobType::class)]
class JobTypeRepository extends AbstractRepository
{
    /**
     * @param array<non-empty-string, mixed> $params
     * @param array<non-empty-string, mixed> $filters
     */
    public function getJobTypes(
        array $params = [],
        array $filters = [],
    ): QueryBuilder {
        $queryBuilder = $this
            ->getQueryBuilder()
            ->select(['jobType'])
            ->from(JobType::class, 'jobType');

        // add filters

        $queryBuilder
            ->orderBy($params['sort'], $params['dir'])
            ->setFirstResult($params['offset'])
            ->setMaxResults($params['limit'])
            ->groupBy('jobType.uuid');
        $queryBuilder->getQuery()->useQueryCache(true);

        return $queryBuilder;
    }
}
