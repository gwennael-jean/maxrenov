<?php

namespace App\Repository;

use App\Entity\Parameter;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Parameter|null find($id, $lockMode = null, $lockVersion = null)
 * @method Parameter|null findOneBy(array $criteria, array $orderBy = null)
 * @method Parameter[]    findAll()
 * @method Parameter[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ParameterRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Parameter::class);
    }

    public function insert(string $domain, string $name, $value)
    {
        return $this->getEntityManager()->getConnection()
            ->insert('parameter', [
                'domain' => $domain,
                'name' => $name,
                'value' => $value
            ])
        ;
    }

    public function update(string $domain, string $name, $value)
    {
        return $this->getEntityManager()->getConnection()
            ->update('parameter', [
                'value' => $value
            ], [
                'domain' => $domain,
                'name' => $name,
            ])
        ;
    }
}