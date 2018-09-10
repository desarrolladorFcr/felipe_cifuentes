<?php

namespace App\Repository;

use App\Entity\Procesos;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Procesos|null find($id, $lockMode = null, $lockVersion = null)
 * @method Procesos|null findOneBy(array $criteria, array $orderBy = null)
 * @method Procesos[]    findAll()
 * @method Procesos[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProcesosRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Procesos::class);
    }

//    /**
//     * @return Procesos[] Returns an array of Procesos objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Procesos
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
