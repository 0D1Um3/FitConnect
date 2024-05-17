<?php

namespace App\Repository;

use App\Entity\TypeSport;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TypeSport>
 *
 * @method TypeSport|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeSport|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeSport[]    findAll()
 * @method TypeSport[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeSportRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TypeSport::class);
    }

    public function findTopByEntries($limit = 3)
    {
        return $this->createQueryBuilder('t')
            ->orderBy('t.entries', 'DESC')
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();
    }

    //    /**
    //     * @return TypeSport[] Returns an array of TypeSport objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('t')
    //            ->andWhere('t.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('t.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?TypeSport
    //    {
    //        return $this->createQueryBuilder('t')
    //            ->andWhere('t.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
