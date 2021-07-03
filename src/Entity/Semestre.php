<?php

namespace App\Entity;

use App\Repository\SemestreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SemestreRepository::class)
 */
class Semestre
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
    private $nome_semestre;


    /**
     * @ORM\OneToMany(targetEntity=Disciplina::class, mappedBy="semestre")
     */
    private $disciplinas;

    /**
     * @ORM\OneToMany(targetEntity=Turma::class, mappedBy="semestre")
     */
    private $Turmas;

    public function __construct()
    {
        $this->disciplinas = new ArrayCollection();
        $this->Turmas = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomeSemestre(): ?string
    {
        return $this->nome_semestre;
    }

    public function setNomeSemestre(string $nome_semestre): self
    {
        $this->nome_semestre = $nome_semestre;

        return $this;
    }


    /**
     * @return Collection|Disciplina[]
     */
    public function getDisciplinas(): Collection
    {
        return $this->disciplinas;
    }

    public function addDisciplina(Disciplina $disciplina): self
    {
        if (!$this->disciplinas->contains($disciplina)) {
            $this->disciplinas[] = $disciplina;
            $disciplina->setSemestre($this);
        }

        return $this;
    }

    public function removeDisciplina(Disciplina $disciplina): self
    {
        if ($this->disciplinas->removeElement($disciplina)) {
            // set the owning side to null (unless already changed)
            if ($disciplina->getSemestre() === $this) {
                $disciplina->setSemestre(null);
            }
        }

        return $this;
    }

    public function __toString(){
        return  $this->nome_semestre ;
    }

    /**
     * @return Collection|Turma[]
     */
    public function getTurmas(): Collection
    {
        return $this->Turmas;
    }

    public function addTurma(Turma $turma): self
    {
        if (!$this->Turmas->contains($turma)) {
            $this->Turmas[] = $turma;
            $turma->setSemestre($this);
        }

        return $this;
    }

    public function removeTurma(Turma $turma): self
    {
        if ($this->Turmas->removeElement($turma)) {
            // set the owning side to null (unless already changed)
            if ($turma->getSemestre() === $this) {
                $turma->setSemestre(null);
            }
        }

        return $this;
    }
}
