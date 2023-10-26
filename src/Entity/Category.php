<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
class Category
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $secteur = null;

    #[ORM\ManyToMany(targetEntity: Entreprise::class, mappedBy: 'categorie')]
    private Collection $entreprises;

    public function __construct()
    {
        $this->entreprises = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSecteur(): ?string
    {
        return $this->secteur;
    }

    public function setSecteur(string $secteur): static
    {
        $this->secteur = $secteur;

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
            $entreprise->addCategorie($this);
        }

        return $this;
    }

    public function removeEntreprise(Entreprise $entreprise): static
    {
        if ($this->entreprises->removeElement($entreprise)) {
            $entreprise->removeCategorie($this);
        }

        return $this;
    }
}
