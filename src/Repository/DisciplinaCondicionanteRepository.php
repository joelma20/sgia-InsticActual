<?php

namespace App\Repository;

use App\Entity\DisciplinaCondicionante;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method DisciplinaCondicionante|null find($id, $lockMode = null, $lockVersion = null)
 * @method DisciplinaCondicionante|null findOneBy(array $criteria, array $orderBy = null)
 * @method DisciplinaCondicionante[]    findAll()
 * @method DisciplinaCondicionante[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DisciplinaCondicionanteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DisciplinaCondicionante::class);
    }

    // /**
    //  * @return DisciplinaCondicionante[] Returns an array of DisciplinaCondicionante objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?DisciplinaCondicionante
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
