<?php

namespace App\Repository;

use App\Entity\QuotationResponse;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method QuotationResponse|null find($id, $lockMode = null, $lockVersion = null)
 * @method QuotationResponse|null findOneBy(array $criteria, array $orderBy = null)
 * @method QuotationResponse[]    findAll()
 * @method QuotationResponse[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class QuotationResponseRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, QuotationResponse::class);
    }

//    /**
//     * @return QuotationResponse[] Returns an array of QuotationResponse objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('q')
            ->andWhere('q.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('q.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?QuotationResponse
    {
        return $this->createQueryBuilder('q')
            ->andWhere('q.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
