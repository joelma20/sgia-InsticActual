<?php

namespace App\Repository;

use App\Entity\DisciplinaProfessoreTurma;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method DisciplinaProfessoreTurma|null find($id, $lockMode = null, $lockVersion = null)
 * @method DisciplinaProfessoreTurma|null findOneBy(array $criteria, array $orderBy = null)
 * @method DisciplinaProfessoreTurma[]    findAll()
 * @method DisciplinaProfessoreTurma[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DisciplinaProfessoreTurmaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DisciplinaProfessoreTurma::class);
    }

    // /**
    //  * @return DisciplinaProfessoreTurma[] Returns an array of DisciplinaProfessoreTurma objects
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
    public function findOneBySomeField($value): ?DisciplinaProfessoreTurma
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
