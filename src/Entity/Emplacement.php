<?php

namespace App\Entity;

use App\Repository\EmplacementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EmplacementRepository::class)]
class Emplacement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\ManyToMany(targetEntity: Entreprise::class, mappedBy: 'emplacement')]
    private Collection $entreprises;

    public function __construct()
    {
        $this->entreprises = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, Entreprise>
     */
    public function getEntreprises(): Collection
    {
        return $this->entreprises;
    }

    public function addEntreprise(Entreprise $entreprise): static
    {
        if (!$this->entreprises->contains($entreprise)) {
            $this->entreprises->add($entreprise);
            $entreprise->addEmplacement($this);
        }

        return $this;
    }

    public function removeEntreprise(Entreprise $entreprise): static
    {
        if ($this->entreprises->removeElement($entreprise)) {
            $entreprise->removeEmplacement($this);
        }

        return $this;
    }
}
