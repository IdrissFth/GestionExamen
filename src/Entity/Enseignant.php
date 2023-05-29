<?php

namespace App\Entity;

use App\Repository\EnseignantRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EnseignantRepository::class)]
class Enseignant
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 20)]
    private ?string $nom = null;

    #[ORM\Column(length: 20)]
    private ?string $prenom = null;

    #[ORM\Column(length: 50)]
    private ?string $email = null;

    #[ORM\Column(length: 8)]
    private ?string $cin = null;

    #[ORM\ManyToMany(targetEntity: Module::class, inversedBy: 'enseignants')]
    private Collection $id_module;

    public function __construct()
    {
        $this->id_module = new ArrayCollection();
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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

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

    public function getCin(): ?string
    {
        return $this->cin;
    }

    public function setCin(string $cin): self
    {
        $this->cin = $cin;

        return $this;
    }

    /**
     * @return Collection<int, Module>
     */
    public function getIdModule(): Collection
    {
        return $this->id_module;
    }

    public function addIdModule(Module $idModule): self
    {
        if (!$this->id_module->contains($idModule)) {
            $this->id_module->add($idModule);
        }

        return $this;
    }

    public function removeIdModule(Module $idModule): self
    {
        $this->id_module->removeElement($idModule);

        return $this;
    }
    public function __toString():string
    {
        return $this->nom;
    }
}
