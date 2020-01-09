<?php
namespace App\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

abstract class AbstractRepository extends ServiceEntityRepository
{
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
}