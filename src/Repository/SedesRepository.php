<?php

namespace App\Repository;

use App\Entity\Sedes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Sedes|null find($id, $lockMode = null, $lockVersion = null)
 * @method Sedes|null findOneBy(array $criteria, array $orderBy = null)
 * @method Sedes[]    findAll()
 * @method Sedes[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SedesRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Sedes::class);
    }

//    /**
//     * @return Sedes[] Returns an array of Sedes objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Sedes
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
