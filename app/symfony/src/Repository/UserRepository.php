<?php
namespace App\Repository;

use App\Entity\User;
use Doctrine\Persistence\ManagerRegistry;

class UserRepository extends AbstractRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }
    
    public function findLast(): ?User
    {
        return $this->createQueryBuilder('u')
            ->orderBy('u.createdAt')
            ->getQuery()
            ->setMaxResults(1)
            ->getOneOrNullResult();
    }
}