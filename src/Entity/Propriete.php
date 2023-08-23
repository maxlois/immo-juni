<?php

namespace App\Entity;

use App\Repository\ProprieteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProprieteRepository::class)]
class Propriete
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;    

    #[ORM\Column(length: 25)]
    private ?float $superficie = null;

    #[ORM\Column]
    private ?bool $statut = null;

    #[ORM\Column(length: 25)]
    private ?int $longeur = null;

    #[ORM\Column(length: 25)]
    private ?int $largeur = null;

    #[ORM\Column(length: 25)]
    private ?int $hauteur = null;

    #[ORM\Column(length: 1)]
    private ?string $photo = null;

    #[ORM\Column(length: 1)]
    private ?string $photo2 = null;

    #[ORM\Column(length: 1)]
    private ?string $photo3 = null;

    #[ORM\Column(length: 1)]
    private ?string $photo4 = null;

    #[ORM\Column(length: 1)]
    private ?string $photo5 = null;

    #[ORM\Column(length: 25)]
    private ?float $prixPro = null;

    #[ORM\Column(length: 255)]
    private ?string $nomPro = null;

    #[ORM\ManyToOne(inversedBy: 'proprietes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $proprietaire = null;

    #[ORM\ManyToOne(inversedBy: 'proprieteGerees')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $gestionnaire = null;

    #[ORM\ManyToOne(inversedBy: 'proprietes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Quartier $quartier = null;

    #[ORM\OneToMany(mappedBy: 'propriete', targetEntity: Location::class)]
    private Collection $locations;

    #[ORM\ManyToOne(inversedBy: 'proprietes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?TypePropriete $typePropriete = null;

    public function __construct()
    {
        $this->locations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSuperficie(): ?float
    {
        return $this->superficie;
    }

    public function setSuperficie(float $superficie): static
    {
        $this->superficie = $superficie;

        return $this;
    }

    public function isStatut(): ?bool
    {
        return $this->statut;
    }

    public function setStatut(bool $statut): static
    {
        $this->statut = $statut;

        return $this;
    }

    public function getLongeur(): ?int
    {
        return $this->longeur;
    }

    public function setLongeur(int $longeur): static
    {
        $this->longeur = $longeur;

        return $this;
    }

    public function getLargeur(): ?int
    {
        return $this->largeur;
    }

    public function setLargeur(int $largeur): static
    {
        $this->largeur = $largeur;

        return $this;
    }

    public function getHauteur(): ?int
    {
        return $this->hauteur;
    }

    public function setHauteur(int $hauteur): static
    {
        $this->hauteur = $hauteur;

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(string $photo): static
    {
        $this->photo = $photo;

        return $this;
    }

    public function getPhoto2(): ?string
    {
        return $this->photo2;
    }

    public function setPhoto2(string $photo2): static
    {
        $this->photo2 = $photo2;

        return $this;
    }

    public function getPhoto3(): ?string
    {
        return $this->photo3;
    }

    public function setPhoto3(string $photo3): static
    {
        $this->photo3 = $photo3;

        return $this;
    }

    public function getPhoto4(): ?string
    {
        return $this->photo4;
    }

    public function setPhoto4(string $photo4): static
    {
        $this->photo4 = $photo4;

        return $this;
    }

    public function getPhoto5(): ?string
    {
        return $this->photo5;
    }

    public function setPhoto5(string $photo5): static
    {
        $this->photo5 = $photo5;

        return $this;
    }

    public function getPrixPro(): ?float
    {
        return $this->prixPro;
    }

    public function setPrixPro(float $prixPro): static
    {
        $this->prixPro = $prixPro;

        return $this;
    }


    public function getNomPro(): ?string
    {
        return $this->nomPro;
    }

    public function setNomPro(string $nomPro): static
    {
        $this->nomPro = $nomPro;

        return $this;
    }

    public function getProprietaire(): ?User
    {
        return $this->proprietaire;
    }

    public function setProprietaire(?User $proprietaire): static
    {
        $this->proprietaire = $proprietaire;

        return $this;
    }

    public function getGestionnaire(): ?User
    {
        return $this->gestionnaire;
    }

    public function setGestionnaire(?User $gestionnaire): static
    {
        $this->gestionnaire = $gestionnaire;

        return $this;
    }

    public function getQuartier(): ?Quartier
    {
        return $this->quartier;
    }

    public function setQuartier(?Quartier $quartier): static
    {
        $this->quartier = $quartier;

        return $this;
    }

    /**
     * @return Collection<int, Location>
     */
    public function getLocations(): Collection
    {
        return $this->locations;
    }

    public function addLocation(Location $location): static
    {
        if (!$this->locations->contains($location)) {
            $this->locations->add($location);
            $location->setPropriete($this);
        }

        return $this;
    }

    public function removeLocation(Location $location): static
    {
        if ($this->locations->removeElement($location)) {
            // set the owning side to null (unless already changed)
            if ($location->getPropriete() === $this) {
                $location->setPropriete(null);
            }
        }

        return $this;
    }

    public function getTypePropriete(): ?TypePropriete
    {
        return $this->typePropriete;
    }

    public function setTypePropriete(?TypePropriete $typePropriete): static
    {
        $this->typePropriete = $typePropriete;

        return $this;
    }

   
}
