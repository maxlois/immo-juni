<?php

namespace App\Repository;

use App\Entity\TypePropriete;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TypePropriete>
 *
 * @method TypePropriete|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypePropriete|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypePropriete[]    findAll()
 * @method TypePropriete[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeProprieteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TypePropriete::class);
    }

//    /**
//     * @return TypePropriete[] Returns an array of TypePropriete objects
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

//    public function findOneBySomeField($value): ?TypePropriete
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
