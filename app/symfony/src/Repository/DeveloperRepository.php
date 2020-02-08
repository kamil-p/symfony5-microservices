<?php
namespace App\Repository;

use App\Entity\Developer;
use Doctrine\Persistence\ManagerRegistry;

class DeveloperRepository extends AbstractRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Developer::class);
    }
    
    public function findLast(): ?Developer
    {
        return $this->createQueryBuilder('u')
            ->getQuery()
            ->setMaxResults(1)
            ->getOneOrNullResult();
    }
}