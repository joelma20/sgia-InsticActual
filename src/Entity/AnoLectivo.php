<?php

namespace App\Entity;

use App\Repository\AnoLectivoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AnoLectivoRepository::class)
 */
class AnoLectivo
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
    private $nome_ano_lectivo;

    /**
     * @ORM\Column(type="date")
     */
    private $data_inicio;

    /**
     * @ORM\OneToMany(targetEntity=Curso::class, mappedBy="anoLectivo")
     */
    private $curso;

    public function __construct()
    {
        $this->curso = new ArrayCollection();
        $this->data_inicio = new \DateTime('now');
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomeAnoLectivo(): ?string
    {
        return $this->nome_ano_lectivo;
    }

    public function setNomeAnoLectivo(string $nome_ano_lectivo): self
    {
        $this->nome_ano_lectivo = $nome_ano_lectivo;

        return $this;
    }

    public function getDataInicio(): ?\DateTimeInterface
    {
        return $this->data_inicio;
    }

    public function setDataInicio(\DateTimeInterface $data_inicio): self
    {
        $this->data_inicio = $data_inicio;

        return $this;
    }

    /**
     * @return Collection|Curso[]
     */
    public function getCurso(): Collection
    {
        return $this->curso;
    }

    public function addCurso(Curso $curso): self
    {
        if (!$this->curso->contains($curso)) {
            $this->curso[] = $curso;
            $curso->setAnoLectivo($this);
        }

        return $this;
    }

    public function removeCurso(Curso $curso): self
    {
        if ($this->curso->removeElement($curso)) {
            // set the owning side to null (unless already changed)
            if ($curso->getAnoLectivo() === $this) {
                $curso->setAnoLectivo(null);
            }
        }

        return $this;
    }

    public function __toString(){
        return $this->nome_ano_lectivo;
    }
}
