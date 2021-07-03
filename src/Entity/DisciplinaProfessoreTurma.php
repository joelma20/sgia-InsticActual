<?php

namespace App\Entity;

use App\Repository\DisciplinaProfessoreTurmaRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DisciplinaProfessoreTurmaRepository::class)
 */
class DisciplinaProfessoreTurma
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Professor::class, inversedBy="disciplinaProfessoreTurmas")
     */
    private $Professore;

    /**
     * @ORM\ManyToOne(targetEntity=Disciplina::class, inversedBy="disciplinaProfessoreTurmas")
     */
    private $Disciplina;

    /**
     * @ORM\ManyToOne(targetEntity=Turma::class, inversedBy="disciplinaProfessoreTurmas")
     */
    private $Turma;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProfessore(): ?Professor
    {
        return $this->Professore;
    }

    public function setProfessore(?Professor $Professore): self
    {
        $this->Professore = $Professore;

        return $this;
    }

    public function getDisciplina(): ?Disciplina
    {
        return $this->Disciplina;
    }

    public function setDisciplina(?Disciplina $Disciplina): self
    {
        $this->Disciplina = $Disciplina;

        return $this;
    }

    public function getTurma(): ?Turma
    {
        return $this->Turma;
    }

    public function setTurma(?Turma $Turma): self
    {
        $this->Turma = $Turma;

        return $this;
    }
}
