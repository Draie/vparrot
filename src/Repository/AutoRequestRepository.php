<?php

namespace App\Repository;

use App\Entity\AutoRequest;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<AutoRequest>
 *
 * @method AutoRequest|null find($id, $lockMode = null, $lockVersion = null)
 * @method AutoRequest|null findOneBy(array $criteria, array $orderBy = null)
 * @method AutoRequest[]    findAll()
 * @method AutoRequest[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AutoRequestRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AutoRequest::class);
    }

//    /**
//     * @return AutoRequest[] Returns an array of AutoRequest objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('a.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?AutoRequest
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
