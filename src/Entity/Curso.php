<?php

namespace App\Entity;

use App\Repository\CursoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CursoRepository::class)
 */
class Curso
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
    private $nome_curso;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $Coordinador;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $phone;

    /**
     * @ORM\ManyToOne(targetEntity=AnoLectivo::class, inversedBy="curso")
     */
    private $anoLectivo;

    /**
     * @ORM\OneToMany(targetEntity=AnoAcademico::class, mappedBy="curso")
     */
    private $ano_academicos;

    public function __construct()
    {
        $this->ano_academicos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomeCurso(): ?string
    {
        return $this->nome_curso;
    }

    public function setNomeCurso(string $nome_curso): self
    {
        $this->nome_curso = $nome_curso;

        return $this;
    }

    public function getCoordinador(): ?string
    {
        return $this->Coordinador;
    }

    public function setCoordinador(string $Coordinador): self
    {
        $this->Coordinador = $Coordinador;

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

    public function getAnoLectivo(): ?AnoLectivo
    {
        return $this->anoLectivo;
    }

    public function setAnoLectivo(?AnoLectivo $anoLectivo): self
    {
        $this->anoLectivo = $anoLectivo;

        return $this;
    }

    /**
     * @return Collection|AnoAcademico[]
     */
    public function getAnoAcademicos(): Collection
    {
        return $this->ano_academicos;
    }

    public function addAnoAcademico(AnoAcademico $anoAcademico): self
    {
        if (!$this->ano_academicos->contains($anoAcademico)) {
            $this->ano_academicos[] = $anoAcademico;
            $anoAcademico->setCurso($this);
        }

        return $this;
    }

    public function removeAnoAcademico(AnoAcademico $anoAcademico): self
    {
        if ($this->ano_academicos->removeElement($anoAcademico)) {
            // set the owning side to null (unless already changed)
            if ($anoAcademico->getCurso() === $this) {
                $anoAcademico->setCurso(null);
            }
        }

        return $this;
    }

    public function __toString(){
        return '('. $this->getAnoLectivo().') - '. $this->nome_curso ;
    }
}
