<?php

namespace App\Repository;

use App\Entity\AnoLectivo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method AnoLectivo|null find($id, $lockMode = null, $lockVersion = null)
 * @method AnoLectivo|null findOneBy(array $criteria, array $orderBy = null)
 * @method AnoLectivo[]    findAll()
 * @method AnoLectivo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AnoLectivoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AnoLectivo::class);
    }

    // /**
    //  * @return AnoLectivo[] Returns an array of AnoLectivo objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?AnoLectivo
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
