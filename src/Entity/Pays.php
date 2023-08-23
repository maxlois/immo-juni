<?php

namespace App\Entity;

use App\Repository\PaysRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PaysRepository::class)]
class Pays
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nomP = null;

    #[ORM\Column(length: 255)]
    private ?string $langue = null;

    #[ORM\Column(length: 25)]
    private ?string $identifTel = null;

    #[ORM\Column(length: 2, nullable: true)]
    private ?string $codeIso = null;

    #[ORM\OneToMany(mappedBy: 'pays', targetEntity: Ville::class)]
    private Collection $villes;

    public function __construct()
    {
        $this->villes = new ArrayCollection();
    }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomP(): ?string
    {
        return $this->nomP;
    }

    public function setNomP(string $nomP): static
    {
        $this->nomP = $nomP;

        return $this;
    }

    public function getLangue(): ?string
    {
        return $this->langue;
    }

    public function setLangue(string $langue): static
    {
        $this->langue = $langue;

        return $this;
    }

    public function getIdentifTel(): ?string
    {
        return $this->identifTel;
    }

    public function setIdentifTel(string $identifTel): static
    {
        $this->identifTel = $identifTel;

        return $this;
    }

    public function getCodeIso(): ?string
    {
        return $this->codeIso;
    }

    public function setCodeIso(?string $codeIso): static
    {
        $this->codeIso = $codeIso;

        return $this;
    }

    /**
     * @return Collection<int, Ville>
     */
    public function getVilles(): Collection
    {
        return $this->villes;
    }

    public function addVille(Ville $ville): static
    {
        if (!$this->villes->contains($ville)) {
            $this->villes->add($ville);
            $ville->setPays($this);
        }

        return $this;
    }

    public function removeVille(Ville $ville): static
    {
        if ($this->villes->removeElement($ville)) {
            // set the owning side to null (unless already changed)
            if ($ville->getPays() === $this) {
                $ville->setPays(null);
            }
        }

        return $this;
    }


    public function __toString()
{
    return $this->nomP;
}
}
