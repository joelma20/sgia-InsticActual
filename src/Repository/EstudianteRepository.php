<?php

namespace App\Repository;

use App\Entity\Estudante;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Estudante|null find($id, $lockMode = null, $lockVersion = null)
 * @method Estudante|null findOneBy(array $criteria, array $orderBy = null)
 * @method Estudante[]    findAll()
 * @method Estudante[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EstudianteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Estudante::class);
    }

    // /**
    //  * @return Estudante[] Returns an array of Estudante objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Estudante
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
