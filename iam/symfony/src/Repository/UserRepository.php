<?php
namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class UserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }
    
    public function save($data): void
    {
        if (empty($data)) {
            return;
        }
        
        if (is_array($data)) {
            foreach ($data as $entity) {
                $this->getEntityManager()->persist($entity);
            }
        } else {
            $this->getEntityManager()->persist($data);
        }
        
        $this->getEntityManager()->flush();
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