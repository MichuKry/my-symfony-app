<?php

namespace App\Repository;

use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Product>
 */
class ProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

    
    public function getLastProduct(): ?Product
    {
        return $this->createQueryBuilder('p')
            ->orderBy('p.createdAt', 'DESC') 
            ->setMaxResults(1)               
            ->getQuery()
            ->getOneOrNullResult();          
    }
    public function searchByQuery(string $query): array
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.name LIKE :val OR p.description LIKE :val')
            ->setParameter('val', '%'.$query.'%')
            ->orderBy('p.createdAt', 'DESC')
            ->getQuery()
            ->getResult();
    }
}