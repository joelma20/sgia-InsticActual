<?php

namespace App\Entity;

use App\Repository\DicsiplinaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DicsiplinaRepository::class)
 */
class Disciplina
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $nome_discilpina;

    /**
     * @ORM\Column(type="integer")
     */
    private $cant_horas;

    /**
     * @ORM\ManyToOne(targetEntity=Semestre::class, inversedBy="disciplinas")
     */
    private $semestre;

    /**
     * @ORM\ManyToMany(targetEntity=Estudante::class, mappedBy="dicsiplinas")
     */
    private $estudiantes;

    /**
     * @ORM\OneToMany(targetEntity=DisciplinaProfessoreTurma::class, mappedBy="Disciplina")
     */
    private $disciplinaProfessoreTurmas;

    public function __construct()
    {
        $this->estudiantes = new ArrayCollection();
        $this->disciplinaProfessoreTurmas = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getNomeDiscilpina()
    {
        return $this->nome_discilpina;
    }

    /**
     * @param mixed $nome_discilpina
     */
    public function setNomeDiscilpina($nome_discilpina): void
    {
        $this->nome_discilpina = $nome_discilpina;
    }

    public function getCantHoras(): ?int
    {
        return $this->cant_horas;
    }

    public function setCantHoras(int $cant_horas): self
    {
        $this->cant_horas = $cant_horas;

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

    public function __toString(){
        return  $this->getsemestre().' - '. $this->getNomeDiscilpina() ;
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
            $estudiante->addDicsiplina($this);
        }

        return $this;
    }

    public function removeEstudiante(Estudante $estudiante): self
    {
        if ($this->estudiantes->removeElement($estudiante)) {
            $estudiante->removeDicsiplina($this);
        }

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
            $disciplinaProfessoreTurma->setDisciplina($this);
        }

        return $this;
    }

    public function removeDisciplinaProfessoreTurma(DisciplinaProfessoreTurma $disciplinaProfessoreTurma): self
    {
        if ($this->disciplinaProfessoreTurmas->removeElement($disciplinaProfessoreTurma)) {
            // set the owning side to null (unless already changed)
            if ($disciplinaProfessoreTurma->getDisciplina() === $this) {
                $disciplinaProfessoreTurma->setDisciplina(null);
            }
        }

        return $this;
    }

}
