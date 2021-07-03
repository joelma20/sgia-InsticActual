<?php

namespace App\Repository;

use App\Entity\AnoAcademico;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method AnoAcademico|null find($id, $lockMode = null, $lockVersion = null)
 * @method AnoAcademico|null findOneBy(array $criteria, array $orderBy = null)
 * @method AnoAcademico[]    findAll()
 * @method AnoAcademico[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AnoAcademicoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AnoAcademico::class);
    }

    public function findbyPrimerAno($idCurso){
        return $this->getEntityManager()
            ->createQuery('
            SELECT AnoAcademico
            FROM App:AnoAcademico AnoAcademico
            JOIN AnoAcademico.curso Curso                             
            WHERE  (Curso.id = :idCurso)                             
            ' )->setParameter('idCurso', $idCurso)
            ->getResult();
    }

    // /**
    //  * @return AnoAcademico[] Returns an array of AnoAcademico objects
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
    public function findOneBySomeField($value): ?AnoAcademico
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
