<?php

namespace App\Repository;

use App\Entity\Turma;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Turma|null find($id, $lockMode = null, $lockVersion = null)
 * @method Turma|null findOneBy(array $criteria, array $orderBy = null)
 * @method Turma[]    findAll()
 * @method Turma[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TurmaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Turma::class);
    }

    public function findbyEstTurmaDisc($Turma){
        return $this->getEntityManager()
            ->createQuery('
            SELECT Matricula.nome_estudiante,
                   turma.nome_turma,
                   disciplina.nome_discilpina,
                   ano.nome_ano_academico,
                   semestre.nome_semestre
            FROM App:Turma turma
            JOIN turma.estudiantes Matricula
            JOIN turma.disciplinas disciplina
            JOIN turma.anoAcademico ano
            JOIN ano.semestres semestre                                 
            WHERE  turma.id = :turmap
            ORDER BY disciplina.nome_discilpina                       
            ' )->setParameter('turmap', $Turma)
            ->getResult();
    }

    public function DisciplinafindbyTurma($Turma){
        return $this->getEntityManager()
            ->createQuery('
            SELECT disciplina.nome_discilpina, turma.nome_turma, turma.id
            FROM App:Turma turma          
            JOIN turma.disciplinas disciplina                                 
            WHERE  turma.id = :turmap
            ORDER BY disciplina.nome_discilpina                            
            ' )->setParameter('turmap', $Turma)
            ->getResult();
    }

    // /**
    //  * @return Turma[] Returns an array of Turma objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Turma
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
