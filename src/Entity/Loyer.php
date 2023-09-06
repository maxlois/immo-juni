<?php

namespace App\Entity;

use App\Repository\LoyerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LoyerRepository::class)]
class Loyer
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?float $prixLoyer = null;

    #[ORM\Column(length: 255)]
    private ?float $coutL = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateLoyer = null;

    #[ORM\Column(length: 255)]
    private ?string $typePaie = null;

    #[ORM\Column(length: 255)]
    private ?string $statutLoy = null;

    #[ORM\Column(length: 255)]
    private ?float $MontLoy = null;

    #[ORM\Column(length: 255)]
    private ?int $appliPenal = null;

    #[ORM\Column(length: 25)]
    private ?string $mois = null;

    #[ORM\Column(length: 255)]
    private ?int $annee = null;

    #[ORM\Column(length: 255)]
    private ?string $modePaie = null;

    #[ORM\Column(length: 255)]
    private ?string $refPaie = null;

    #[ORM\Column(length: 255)]
    private ?float $montPaie = null;

    #[ORM\ManyToOne(inversedBy: 'loyers')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Location $location = null;

    public function __construct()
    {
        $this->locations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrixLoyer(): ?float
    {
        return $this->prixLoyer;
    }

    public function setPrixLoyer(float $prixLoyer): static
    {
        $this->prixLoyer = $prixLoyer;

        return $this;
    }

    public function getCoutL(): ?float
    {
        return $this->coutL;
    }

    public function setCoutL(float $coutL): static
    {
        $this->coutL = $coutL;

        return $this;
    }

    public function getDateLoyer(): ?\DateTimeInterface
    {
        return $this->dateLoyer;
    }

    public function setDateLoyer(\DateTimeInterface $dateLoyer): static
    {
        $this->dateLoyer = $dateLoyer;

        return $this;
    }

    public function getTypePaie(): ?string
    {
        return $this->typePaie;
    }

    public function setTypePaie(string $typePaie): static
    {
        $this->typePaie = $typePaie;

        return $this;
    }

    public function getStatutLoy(): ?string
    {
        return $this->statutLoy;
    }

    public function setStatutLoy(string $statutLoy): static
    {
        $this->statutLoy = $statutLoy;

        return $this;
    }

    public function getMontLoy(): ?float
    {
        return $this->MontLoy;
    }

    public function setMontLoy(float $MontLoy): static
    {
        $this->MontLoy = $MontLoy;

        return $this;
    }

    public function getAppliPenal(): ?int
    {
        return $this->appliPenal;
    }

    public function setAppliPenal(int $appliPenal): static
    {
        $this->appliPenal = $appliPenal;

        return $this;
    }

    public function getMois(): ?string
    {
        return $this->mois;
    }

    public function setMois(string $mois): static
    {
        $this->mois = $mois;

        return $this;
    }

    public function getAnnee(): ?int
    {
        return $this->annee;
    }

    public function setAnnee(int $annee): static
    {
        $this->annee = $annee;

        return $this;
    }

    public function getModePaie(): ?string
    {
        return $this->modePaie;
    }

    public function setModePaie(string $modePaie): static
    {
        $this->modePaie = $modePaie;

        return $this;
    }

    public function getRefPaie(): ?string
    {
        return $this->refPaie;
    }

    public function setRefPaie(string $refPaie): static
    {
        $this->refPaie = $refPaie;

        return $this;
    }

    public function getMontPaie(): ?float
    {
        return $this->montPaie;
    }

    public function setMontPaie(float $montPaie): static
    {
        $this->montPaie = $montPaie;

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
            $location->setLoyer($this);
        }

        return $this;
    }

    public function removeLocation(Location $location): static
    {
        if ($this->locations->removeElement($location)) {
            // set the owning side to null (unless already changed)
            if ($location->getLoyer() === $this) {
                $location->setLoyer(null);
            }
        }

        return $this;
    }

    public function getLocation(): ?Location
    {
        return $this->location;
    }

    public function setLocation(?Location $location): static
    {
        $this->location = $location;

        return $this;
    }
}
