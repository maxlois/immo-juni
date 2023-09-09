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

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateLoyer = null;

    #[ORM\Column(length: 255)]
    private ?bool $typePaie = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?bool $statutLoy = null;

    #[ORM\Column(length: 255)]
    private ?float $MontLoy = null;

    #[ORM\Column(length: 255)]
    private ?bool $appliPenal = null;

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

    public function getDateLoyer(): ?\DateTimeInterface
    {
        return $this->dateLoyer;
    }

    public function setDateLoyer(\DateTimeInterface $dateLoyer): static
    {
        $this->dateLoyer = $dateLoyer;

        return $this;
    }

    public function getTypePaie(): ?bool
    {
        return $this->typePaie;
    }

    public function setTypePaie(bool $typePaie): static
    {
        $this->typePaie = $typePaie;

        return $this;
    }

    public function getStatutLoy(): ?bool
    {
        return $this->statutLoy;
    }

    public function setStatutLoy(bool $statutLoy): static
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

    public function getAppliPenal(): ?bool
    {
        return $this->appliPenal;
    }

    public function setAppliPenal(bool $appliPenal): static
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
