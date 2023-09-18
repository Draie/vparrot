<?php

namespace App\Repository;

use App\Entity\RequestManagement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<RequestManagement>
 *
 * @method RequestManagement|null find($id, $lockMode = null, $lockVersion = null)
 * @method RequestManagement|null findOneBy(array $criteria, array $orderBy = null)
 * @method RequestManagement[]    findAll()
 * @method RequestManagement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RequestManagementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RequestManagement::class);
    }

//    /**
//     * @return RequestManagement[] Returns an array of RequestManagement objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('r.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?RequestManagement
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
