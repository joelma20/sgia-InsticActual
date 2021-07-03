<?php

namespace App\Entity;

use App\Repository\TurmaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TurmaRepository::class)
 */
class Turma
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
    private $nome_turma;

    /**
     * @ORM\Column(type="string", length=60)
     */
    private $delegado;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $phone;

    /**
     * @ORM\ManyToOne(targetEntity=AnoAcademico::class, inversedBy="turmas")
     */
    private $anoAcademico;

    /**
     * @ORM\ManyToMany(targetEntity=Estudante::class, inversedBy="turmas")
     */
    private $estudiantes;

    /**
     * @ORM\OneToMany(targetEntity=DisciplinaProfessoreTurma::class, mappedBy="Turma")
     */
    private $disciplinaProfessoreTurmas;

    /**
     * @ORM\ManyToOne(targetEntity=Semestre::class, inversedBy="Turmas")
     */
    private $semestre;

    public function __construct()
    {
        $this->estudiantes = new ArrayCollection();
        $this->disciplinaProfessoreTurmas = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomeTurma(): ?string
    {
        return $this->nome_turma;
    }

    public function setNomeTurma(string $nome_turma): self
    {
        $this->nome_turma = $nome_turma;

        return $this;
    }

    public function getDelegado(): ?string
    {
        return $this->delegado;
    }

    public function setDelegado(string $delegado): self
    {
        $this->delegado = $delegado;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function __toString(){
        return  $this->getanoAcademico().' - '. $this->nome_turma ;
    }


    public function getAnoAcademico(): ?AnoAcademico
    {
        return $this->anoAcademico;
    }

    public function setAnoAcademico(?AnoAcademico $anoAcademico): self
    {
        $this->anoAcademico = $anoAcademico;

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
        }

        return $this;
    }

    public function removeEstudiante(Estudante $estudiante): self
    {
        $this->estudiantes->removeElement($estudiante);

        return $this;
    }

    /**
     * @return Collection|DisciplinaProfessoreTurma[]
     */
    public function getDisciplinaProfessoreTurmas(): Collection
    {
        return $this->disciplinaProfessoreTurmas;
    }

    public function addDisciplinaProfessoreTurma(DisciplinaProfessoreTurma $disciplinaProfessoreTurma): self
    {
        if (!$this->disciplinaProfessoreTurmas->contains($disciplinaProfessoreTurma)) {
            $this->disciplinaProfessoreTurmas[] = $disciplinaProfessoreTurma;
            $disciplinaProfessoreTurma->setTurma($this);
        }

        return $this;
    }

    public function removeDisciplinaProfessoreTurma(DisciplinaProfessoreTurma $disciplinaProfessoreTurma): self
    {
        if ($this->disciplinaProfessoreTurmas->removeElement($disciplinaProfessoreTurma)) {
            // set the owning side to null (unless already changed)
            if ($disciplinaProfessoreTurma->getTurma() === $this) {
                $disciplinaProfessoreTurma->setTurma(null);
            }
        }

        return $this;
    }

    public function getSemestre(): ?Semestre
    {
        return $this->semestre;
    }

    public function setSemestre(?Semestre $semestre): self
    {
        $this->semestre = $semestre;

        return $this;
    }


}
