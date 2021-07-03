<?php

namespace App\Entity;

use App\Repository\ProfessorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProfessorRepository::class)
 */
class Professor
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
    private $nome;

    /**
     * @ORM\Column(type="integer")
     */
    private $telefone;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $email;

    /**
     * @ORM\OneToMany(targetEntity=DisciplinaProfessoreTurma::class, mappedBy="Professore")
     */
    private $disciplinaProfessoreTurmas;

    public function __construct()
    {
        $this->disciplinaProfessoreTurmas = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNome(): ?string
    {
        return $this->nome;
    }

    public function setNome(string $nome): self
    {
        $this->nome = $nome;

        return $this;
    }

    public function getTelefone(): ?int
    {
        return $this->telefone;
    }

    public function setTelefone(int $telefone): self
    {
        $this->telefone = $telefone;

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

    public function __toString()
    {
        return $this->getNome();
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
            $disciplinaProfessoreTurma->setProfessore($this);
        }

        return $this;
    }

    public function removeDisciplinaProfessoreTurma(DisciplinaProfessoreTurma $disciplinaProfessoreTurma): self
    {
        if ($this->disciplinaProfessoreTurmas->removeElement($disciplinaProfessoreTurma)) {
            // set the owning side to null (unless already changed)
            if ($disciplinaProfessoreTurma->getProfessore() === $this) {
                $disciplinaProfessoreTurma->setProfessore(null);
            }
        }

        return $this;
    }
}
