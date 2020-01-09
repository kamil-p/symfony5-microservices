<?php
namespace App\Repository;

use App\Entity\Repo;
use Doctrine\Persistence\ManagerRegistry;

class RepoRepository extends AbstractRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Repo::class);
    }
}