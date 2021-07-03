<?php

namespace App\Entity;

use App\Repository\AnoAcademicoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AnoAcademicoRepository::class)
 */
class AnoAcademico
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $nome_ano_academico;

    /**
     * @ORM\ManyToOne(targetEntity=Curso::class, inversedBy="ano_academicos")
     */
    private $curso;

    /**
     * @ORM\OneToMany(targetEntity=Semestre::class, mappedBy="anoAcademico")
     */
    private $semestres;

    /**
     * @ORM\OneToMany(targetEntity=Turma::class, mappedBy="anoAcademico")
     */
    private $turmas;

    /**
     * @ORM\OneToMany(targetEntity=Estudante::class, mappedBy="anoAcademico")
     */
    private $estudiantes;

    public function __construct()
    {
        $this->semestres = new ArrayCollection();
        $this->estudiantes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomeAnoAcademico(): ?string
    {
        return $this->nome_ano_academico;
    }

    public function setNomeAnoAcademico(string $nome_ano_academico): self
    {
        $this->nome_ano_academico = $nome_ano_academico;

        return $this;
    }

    public function getCurso(): ?Curso
    {
        return $this->curso;
    }

    public function setCurso(?Curso $curso): self
    {
        $this->curso = $curso;

        return $this;
    }

    public function __toString(){
            return $this->getcurso().' - '. $this->nome_ano_academico ;
    }

    /**
     * @return Collection|Turma[]
     */
    public function getTurmas(): Collection
    {
        return $this->turmas;
    }

    public function addTurma(Turma $turma): self
    {
        if (!$this->turmas->contains($turma)) {
            $this->turmas[] = $turma;
            $turma->setAnoAcademico($this);
        }

        return $this;
    }

    public function removeTurma(Turma $turma): self
    {
        if ($this->turmas->removeElement($turma)) {
            // set the owning side to null (unless already changed)
            if ($turma->getAnoAcademico() === $this) {
                $turma->setAnoAcademico(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Estudante[]
     */
    public function getEstudiantes(): Collection
    {
        return $this->estudiantes;
    }

    public function addEstudiante(Estudante $estudiante): self
    {
        if (!$this->estudiantes->contains($estudiante)) {
            $this->estudiantes[] = $estudiante;
            $estudiante->setAnoAcademico($this);
        }

        return $this;
    }

    public function removeEstudiante(Estudante $estudiante): self
    {
        if ($this->estudiantes->removeElement($estudiante)) {
            // set the owning side to null (unless already changed)
            if ($estudiante->getAnoAcademico() === $this) {
                $estudiante->setAnoAcademico(null);
            }
        }

        return $this;
    }

}
