<?php

namespace App\Entity;

use App\Repository\EntrepriseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EntrepriseRepository::class)]
class Entreprise
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $adresse = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $telephone = null;

    #[ORM\ManyToMany(targetEntity: User::class, mappedBy: 'entreprises')]
    private Collection $users;

    #[ORM\ManyToMany(targetEntity: Emplacement::class, inversedBy: 'entreprises')]
    private Collection $emplacement;

    #[ORM\ManyToMany(targetEntity: Category::class, inversedBy: 'entreprises')]
    private Collection $categorie;

    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->emplacement = new ArrayCollection();
        $this->categorie = new ArrayCollection();
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

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): static
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): static
    {
        $this->telephone = $telephone;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): static
    {
        if (!$this->users->contains($user)) {
            $this->users->add($user);
            $user->addEntreprise($this);
        }

        return $this;
    }

    public function removeUser(User $user): static
    {
        if ($this->users->removeElement($user)) {
            $user->removeEntreprise($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Emplacement>
     */
    public function getEmplacement(): Collection
    {
        return $this->emplacement;
    }

    public function addEmplacement(Emplacement $emplacement): static
    {
        if (!$this->emplacement->contains($emplacement)) {
            $this->emplacement->add($emplacement);
        }

        return $this;
    }

    public function removeEmplacement(Emplacement $emplacement): static
    {
        $this->emplacement->removeElement($emplacement);

        return $this;
    }

    /**
     * @return Collection<int, Category>
     */
    public function getCategorie(): Collection
    {
        return $this->categorie;
    }

    public function addCategorie(Category $categorie): static
    {
        if (!$this->categorie->contains($categorie)) {
            $this->categorie->add($categorie);
        }

        return $this;
    }

    public function removeCategorie(Category $categorie): static
    {
        $this->categorie->removeElement($categorie);

        return $this;
    }
}
