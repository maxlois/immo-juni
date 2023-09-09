<?php

namespace App\Entity;

use App\Repository\LocationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LocationRepository::class)]
class Location
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateD_location = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ? int $penalite = null;

    #[ORM\Column(length: 255)]
    private ? int $delaisPaiem = null;

    #[ORM\Column(length: 255)]
    private ? float $causionEnt = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ? float $causionSort = null;

    #[ORM\Column(length: 255)]
    private ?string $etatLieuFile = null;

    #[ORM\ManyToOne(inversedBy: 'locations')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Propriete $propriete = null;

    #[ORM\ManyToOne(inversedBy: 'locations')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $locataire = null;

    #[ORM\Column(length: 255)]
    private ?string $mois = null;

    #[ORM\Column]
    private ?int $annee = null;

    #[ORM\Column(length: 255)]
    private ?string $moisAvance = null;

    #[ORM\OneToMany(mappedBy: 'location', targetEntity: Loyer::class)]
    private Collection $loyers;

    public function __construct()
    {
        $this->loyers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateDLocation(): ?\DateTimeInterface
    {
        return $this->dateD_location;
    }

    public function setDateDLocation(\DateTimeInterface $dateD_location): static
    {
        $this->dateD_location = $dateD_location;

        return $this;
    }

    public function getPenalite(): ? int
    {
        return $this->penalite;
    }

    public function setPenalite(?int $penalite): static
    {
        $this->penalite = $penalite;

        return $this;
    }

    public function getDelaisPaiem(): ?int
    {
        return $this->delaisPaiem;
    }

    public function setDelaisPaiem(int $delaisPaiem): static
    {
        $this->delaisPaiem = $delaisPaiem;

        return $this;
    }

    public function getCausionEnt(): ?float
    {
        return $this->causionEnt;
    }

    public function setCausionEnt(float $causionEnt): static
    {
        $this->causionEnt = $causionEnt;

        return $this;
    }

    public function getCausionSort(): ?float
    {
        return $this->causionSort;
    }

    public function setCausionSort(float $causionSort): static
    {
        $this->causionSort = $causionSort;

        return $this;
    }

    public function getEtatLieuFile(): ?string
    {
        return $this->etatLieuFile;
    }

    public function setEtatLieu(string $etatLieuFile): static
    {
        $this->etatLieuFile = $etatLieuFile;

        return $this;
    }

    public function getPropriete(): ?Propriete
    {
        return $this->propriete;
    }

    public function setPropriete(?Propriete $propriete): static
    {
        $this->propriete = $propriete;

        return $this;
    }

    public function getLocataire(): ?User
    {
        return $this->locataire;
    }

    public function setLocataire(?User $locataire): static
    {
        $this->locataire = $locataire;

        return $this;
    }

    public function __toString()
    {
       return $this->delaisPaiem;
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

    public function getMoisAvance(): ?string
    {
        return $this->moisAvance;
    }

    public function setMoisAvance(string $moisAvance): static
    {
        $this->moisAvance = $moisAvance;

        return $this;
    }

    /**
     * @return Collection<int, Loyer>
     */
    public function getLoyers(): Collection
    {
        return $this->loyers;
    }

    public function addLoyer(Loyer $loyer): static
    {
        if (!$this->loyers->contains($loyer)) {
            $this->loyers->add($loyer);
            $loyer->setLocation($this);
        }

        return $this;
    }

    public function removeLoyer(Loyer $loyer): static
    {
        if ($this->loyers->removeElement($loyer)) {
            // set the owning side to null (unless already changed)
            if ($loyer->getLocation() === $this) {
                $loyer->setLocation(null);
            }
        }

        return $this;
    }

   

}
