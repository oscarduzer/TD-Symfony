<?php

namespace App\Repository;

use App\Entity\TypeEmplacement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TypeEmplacement>
 *
 * @method TypeEmplacement|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeEmplacement|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeEmplacement[]    findAll()
 * @method TypeEmplacement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeEmplacementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TypeEmplacement::class);
    }

    //    /**
    //     * @return TypeEmplacement[] Returns an array of TypeEmplacement objects
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

    //    public function findOneBySomeField($value): ?TypeEmplacement
    //    {
    //        return $this->createQueryBuilder('t')
    //            ->andWhere('t.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
