<?php

namespace App\Entity;

use App\Repository\NoteRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NoteRepository::class)]
class Note
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 20)]
    private ?string $note = null;

    #[ORM\ManyToOne(inversedBy: 'notes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Etudiant $id_etudiant = null;

    #[ORM\ManyToOne(inversedBy: 'notes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Module $id_module = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNote(): ?string
    {
        return $this->note;
    }

    public function setNote(string $note): self
    {
        $this->note = $note;

        return $this;
    }

    public function getIdEtudiant(): ?Etudiant
    {
        return $this->id_etudiant;
    }

    public function setIdEtudiant(?Etudiant $id_etudiant): self
    {
        $this->id_etudiant = $id_etudiant;

        return $this;
    }

    public function getIdModule(): ?Module
    {
        return $this->id_module;
    }

    public function setIdModule(?Module $id_module): self
    {
        $this->id_module = $id_module;

        return $this;
    }
}
