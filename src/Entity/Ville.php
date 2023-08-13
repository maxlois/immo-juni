<?php

namespace App\Entity;

use App\Repository\VilleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VilleRepository::class)]
class Ville
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nomV = null;

    #[ORM\Column(length: 255)]
    private ?string $codePostV = null;

    #[ORM\OneToMany(mappedBy: 'ville', targetEntity: Quartier::class)]
    private Collection $quartiers;

    #[ORM\ManyToOne(inversedBy: 'villes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Pays $pays = null;

    public function __construct()
    {
        $this->quartiers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomV(): ?string
    {
        return $this->nomV;
    }

    public function setNomV(string $nomV): static
    {
        $this->nomV = $nomV;

        return $this;
    }

    public function getCodePostV(): ?string
    {
        return $this->codePostV;
    }

    public function setCodePostV(string $codePostV): static
    {
        $this->codePostV = $codePostV;

        return $this;
    }

    /**
     * @return Collection<int, Quartier>
     */
    public function getQuartiers(): Collection
    {
        return $this->quartiers;
    }

    public function addQuartier(Quartier $quartier): static
    {
        if (!$this->quartiers->contains($quartier)) {
            $this->quartiers->add($quartier);
            $quartier->setVille($this);
        }

        return $this;
    }

    public function removeQuartier(Quartier $quartier): static
    {
        if ($this->quartiers->removeElement($quartier)) {
            // set the owning side to null (unless already changed)
            if ($quartier->getVille() === $this) {
                $quartier->setVille(null);
            }
        }

        return $this;
    }

    public function getPays(): ?Pays
    {
        return $this->pays;
    }

    public function setPays(?Pays $pays): static
    {
        $this->pays = $pays;

        return $this;
    }
}
