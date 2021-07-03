<?php

namespace App\Entity;

use App\Repository\EstudianteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
/**
 * @ORM\Entity(repositoryClass=EstudianteRepository::class)
 *  @Vich\Uploadable
 */

class Estudante implements \Serializable
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=80)
     */
    private $nome_estudiante;


     /**
     * @ORM\ManyToOne(targetEntity=AnoAcademico::class, inversedBy="estudiantes")
     */
     private $anoAcademico;

     /**
      * @ORM\ManyToMany(targetEntity=Turma::class, mappedBy="estudiantes")
      */
     private $turmas;

    /**
     *@var string|null
     * @ORM\Column(type="string", length=255, nullable=true)
     */
     private $Fotografia;

    /**
     * @var File|null
     * @Vich\UploadableField(mapping="estudante_foto", fileNameProperty="Fotografia" )
     *
     */
    private $FotografiaFile;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updated_at;

     /**
      * @ORM\Column(type="integer")
      */
     private $NumProcesso;

     /**
      * @ORM\Column(type="string", length=50)
      */
     private $email;

     /**
      * @ORM\Column(type="integer")
      */
     private $telefone;

     /**
      * @ORM\Column(type="string", length=50)
      */
     private $BI;

     /**
      * @ORM\Column(type="date")
      */
     private $DataNascimento;

     /**
      * @ORM\Column(type="boolean")
      */
     private $Discapacidade;

     /**
      * @ORM\ManyToMany(targetEntity=Disciplina::class, inversedBy="estudiantes")
      */
     private $dicsiplinas;

     public function __construct()
     {
         $this->turmas = new ArrayCollection();
         $this->dicsiplinas = new ArrayCollection();
     }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomeEstudiante(): ?string
    {
        return $this->nome_estudiante;
    }

    public function setNomeEstudiante(string $nome_estudiante): self
    {
        $this->nome_estudiante = $nome_estudiante;

        return $this;
    }

    public function __toString(){
        return  $this->getanoAcademico().' - '. $this->nome_estudiante ;
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
            $turma->addEstudiante($this);
        }

        return $this;
    }

    public function removeTurma(Turma $turma): self
    {
        if ($this->turmas->removeElement($turma)) {
            $turma->removeEstudiante($this);
        }

        return $this;
    }

    /**
     * @return null|string
     */
    public function getFotografia(): ?string
    {
        return $this->Fotografia;
    }

    /**
     * @param null|string $Fotografia
     */
    public function setFotografia(?string $Fotografia): void
    {
        $this->Fotografia = $Fotografia;
    }

    /**
     * @return null|File
     */
    public function getFotografiaFile(): ?File
    {
        return $this->FotografiaFile;
    }

    /**
     * @param null|File $FotografiaFile
     *@return Estudante
     */
    public function setFotografiaFile(?File $FotografiaFile): Estudante
    {
        $this->FotografiaFile = $FotografiaFile;
        if ($this->FotografiaFile instanceof UploadedFile){
            $this->updated_at = new \DateTime('now');
        }
        return $this;

    }


    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(\DateTimeInterface $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    public function getNumProcesso(): ?int
    {
        return $this->NumProcesso;
    }

    public function setNumProcesso(int $NumProcesso): self
    {
        $this->NumProcesso = $NumProcesso;

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

    public function getTelefone(): ?int
    {
        return $this->telefone;
    }

    public function setTelefone(int $telefone): self
    {
        $this->telefone = $telefone;

        return $this;
    }

    public function getBI(): ?string
    {
        return $this->BI;
    }

    public function setBI(string $BI): self
    {
        $this->BI = $BI;

        return $this;
    }

    public function getDataNascimento(): ?\DateTimeInterface
    {
        return $this->DataNascimento;
    }

    public function setDataNascimento(\DateTimeInterface $DataNascimento): self
    {
        $this->DataNascimento = $DataNascimento;

        return $this;
    }

    public function getDiscapacidade(): ?bool
    {
        return $this->Discapacidade;
    }

    public function setDiscapacidade(bool $Discapacidade): self
    {
        $this->Discapacidade = $Discapacidade;

        return $this;
    }

    /**
     * String representation of object
     * @link https://php.net/manual/en/serializable.serialize.php
     * @return string the string representation of the object or null
     * @since 5.1.0
     */
    public function serialize()
    {
        $this->FotografiaFile = base64_encode($this->FotografiaFile);
    }

    /**
     * Constructs the object
     * @link https://php.net/manual/en/serializable.unserialize.php
     * @param string $serialized <p>
     * The string representation of the object.
     * </p>
     * @return void
     * @since 5.1.0
     */
    public function unserialize($serialized)
    {
        $this->FotografiaFile = base64_decode($this->FotografiaFile);
    }

    /**
     * @return Collection|Disciplina[]
     */
    public function getDicsiplinas(): Collection
    {
        return $this->dicsiplinas;
    }

    public function addDicsiplina(Disciplina $dicsiplina): self
    {
        if (!$this->dicsiplinas->contains($dicsiplina)) {
            $this->dicsiplinas[] = $dicsiplina;
        }

        return $this;
    }

    public function removeDicsiplina(Disciplina $dicsiplina): self
    {
        $this->dicsiplinas->removeElement($dicsiplina);

        return $this;
    }
}
