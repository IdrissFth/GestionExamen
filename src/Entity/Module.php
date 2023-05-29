<?php

namespace App\Entity;

use App\Repository\ModuleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ModuleRepository::class)]
class Module
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 20)]
    private ?string $nom = null;

    #[ORM\OneToMany(mappedBy: 'id_module', targetEntity: Note::class)]
    private Collection $notes;

    #[ORM\ManyToOne(inversedBy: 'modules')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Filliere $id_filliere = null;

    #[ORM\ManyToOne(inversedBy: 'modules')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Semestre $id_semestre = null;

    #[ORM\ManyToMany(targetEntity: Enseignant::class, mappedBy: 'id_module')]
    private Collection $enseignants;

    public function __construct()
    {
        $this->notes = new ArrayCollection();
        $this->enseignants = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * @return Collection<int, Note>
     */
    public function getNotes(): Collection
    {
        return $this->notes;
    }

    public function addNote(Note $note): self
    {
        if (!$this->notes->contains($note)) {
            $this->notes->add($note);
            $note->setIdModule($this);
        }

        return $this;
    }

    public function removeNote(Note $note): self
    {
        if ($this->notes->removeElement($note)) {
            // set the owning side to null (unless already changed)
            if ($note->getIdModule() === $this) {
                $note->setIdModule(null);
            }
        }

        return $this;
    }

    public function getIdFilliere(): ?Filliere
    {
        return $this->id_filliere;
    }

    public function setIdFilliere(?Filliere $id_filliere): self
    {
        $this->id_filliere = $id_filliere;

        return $this;
    }

    public function getIdSemestre(): ?Semestre
    {
        return $this->id_semestre;
    }

    public function setIdSemestre(?Semestre $id_semestre): self
    {
        $this->id_semestre = $id_semestre;

        return $this;
    }

    /**
     * @return Collection<int, Enseignant>
     */
    public function getEnseignants(): Collection
    {
        return $this->enseignants;
    }

    public function addEnseignant(Enseignant $enseignant): self
    {
        if (!$this->enseignants->contains($enseignant)) {
            $this->enseignants->add($enseignant);
            $enseignant->addIdModule($this);
        }

        return $this;
    }

    public function removeEnseignant(Enseignant $enseignant): self
    {
        if ($this->enseignants->removeElement($enseignant)) {
            $enseignant->removeIdModule($this);
        }

        return $this;
    }
    public function __toString():string
    {
        return $this->nom;
    }
}
