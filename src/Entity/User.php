<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $prenom = null;

    #[ORM\Column(type: Types::DATE_IMMUTABLE)]
    private ?\DateTimeImmutable $dateNais = null;

    #[ORM\Column(length: 10)]
    private ?string $tel = null;

    #[ORM\Column(length: 25)]
    private ?string $genre = null;

    #[ORM\Column(length: 25)]
    private ?string $nationalite = null;

    #[ORM\Column(length: 25, nullable: true)]
    private ?string $profession = null;

    #[ORM\Column(length: 25)]
    private ?string $tyPiece = null;

    #[ORM\Column(length: 25)]
    private ?string $numPiece = null;

    #[ORM\Column(length: 25)]
    private ?string $actCompte = null;

    #[ORM\Column(length: 255)]
    private ?string $verifCompte = null;

    #[ORM\OneToMany(mappedBy: 'proprietaire', targetEntity: Propriete::class)]
    private Collection $proprietes;

    #[ORM\OneToMany(mappedBy: 'gestionnaire', targetEntity: Propriete::class)]
    private Collection $proprieteGerees;

    #[ORM\Column(length: 255)]
    private ?string $adress = null;

    public function __construct()
    {
        $this->proprietes = new ArrayCollection();
        $this->proprieteGerees = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getDateNais(): ?\DateTimeImmutable
    {
        return $this->dateNais;
    }

    public function setDateNais(\DateTimeImmutable $dateNais): static
    {
        $this->dateNais = $dateNais;

        return $this;
    }

    public function getTel(): ?string
    {
        return $this->tel;
    }

    public function setTel(string $tel): static
    {
        $this->tel = $tel;

        return $this;
    }

    public function getGenre(): ?bool
    {
        return $this->genre;
    }

    public function setGenre(bool $genre): static
    {
        $this->genre = $genre;

        return $this;
    }

    public function getNationalite(): ?string
    {
        return $this->nationalite;
    }

    public function setNationalite(string $nationalite): static
    {
        $this->nationalite = $nationalite;

        return $this;
    }

    public function getProfession(): ?string
    {
        return $this->profession;
    }

    public function setProfession(?string $profession): static
    {
        $this->profession = $profession;

        return $this;
    }

    public function getTyPiece(): ?string
    {
        return $this->tyPiece;
    }

    public function setTyPiece(string $tyPiece): static
    {
        $this->tyPiece = $tyPiece;

        return $this;
    }

    public function getNumPiece(): ?string
    {
        return $this->numPiece;
    }

    public function setNumPiece(string $numPiece): static
    {
        $this->numPiece = $numPiece;

        return $this;
    }

    public function getActCompte(): ?Bool
    {
        return $this->actCompte;
    }

    public function setActCompte(Bool $actCompte): static
    {
        $this->actCompte = $actCompte;

        return $this;
    }

    public function getVerifCompte(): ?Bool
    {
        return $this->verifCompte;
    }

    public function setVerifCompte(Bool $verifCompte): static
    {
        $this->verifCompte = $verifCompte;

        return $this;
    }

    /**
     * @return Collection<int, Propriete>
     */
    public function getProprietes(): Collection
    {
        return $this->proprietes;
    }

    public function addPropriete(Propriete $propriete): static
    {
        if (!$this->proprietes->contains($propriete)) {
            $this->proprietes->add($propriete);
            $propriete->setProprietaire($this);
        }

        return $this;
    }

    public function removePropriete(Propriete $propriete): static
    {
        if ($this->proprietes->removeElement($propriete)) {
            // set the owning side to null (unless already changed)
            if ($propriete->getProprietaire() === $this) {
                $propriete->setProprietaire(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Propriete>
     */
    public function getProprieteGerees(): Collection
    {
        return $this->proprieteGerees;
    }

    public function addProprieteGeree(Propriete $proprieteGeree): static
    {
        if (!$this->proprieteGerees->contains($proprieteGeree)) {
            $this->proprieteGerees->add($proprieteGeree);
            $proprieteGeree->setGestionnaire($this);
        }

        return $this;
    }

    public function removeProprieteGeree(Propriete $proprieteGeree): static
    {
        if ($this->proprieteGerees->removeElement($proprieteGeree)) {
            // set the owning side to null (unless already changed)
            if ($proprieteGeree->getGestionnaire() === $this) {
                $proprieteGeree->setGestionnaire(null);
            }
        }

        return $this;
    }


    public function __toString()
    {
        return $this->nom;
    }

    public function getAdress(): ?string
    {
        return $this->adress;
    }

    public function setAdress(string $adress): static
    {
        $this->adress = $adress;

        return $this;
    }
}
