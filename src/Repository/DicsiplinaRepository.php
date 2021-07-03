<?php

namespace App\Repository;

use App\Entity\Disciplina;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Disciplina|null find($id, $lockMode = null, $lockVersion = null)
 * @method Disciplina|null findOneBy(array $criteria, array $orderBy = null)
 * @method Disciplina[]    findAll()
 * @method Disciplina[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DicsiplinaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Disciplina::class);
    }


    public function EstufindbyDisc($Disciplina){
        return $this->getEntityManager()
            ->createQuery('
            SELECT 
                   turma.nome_turma,
                   estud.nome_estudiante,
                   disciplina.nome_discilpina, 
                   ano.nome_ano_academico,
                   semestres.nome_semestre,
                   curso.nome_curso,
                   ano_lectivo.nome_ano_lectivo                    
            
            FROM App:Disciplina disciplina
            
            JOIN disciplina.turmaas turma
            JOIN turma.estudiantes estud
            JOIN estud.anoAcademico ano
            JOIN ano.semestres semestres
            JOIN ano.curso curso
            JOIN curso.anoLectivo ano_lectivo
                                           
            WHERE  disciplina.id = :discp           
            
            
            ORDER BY turma.nome_turma, estud.nome_estudiante          
                          
            ' )->setParameter('discp', $Disciplina)
            ->getResult();
    }
    // /**
    //  * @return Disciplina[] Returns an array of Disciplina objects
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
    public function findOneBySomeField($value): ?Disciplina
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
