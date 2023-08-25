<?php

namespace App\Entity;

use App\Repository\QuartierRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: QuartierRepository::class)]
class Quartier
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nomQuartier = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?int $numRue = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $codePost = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $localQ = null;

    #[ORM\ManyToOne(inversedBy: 'quartiers')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Ville $ville = null;

    #[ORM\OneToMany(mappedBy: 'quartier', targetEntity: Propriete::class)]
    private Collection $proprietes;

    public function __construct()
    {
        $this->proprietes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomQuartier(): ?string
    {
        return $this->nomQuartier;
    }

    public function setNomQuartier(string $nomQuartier): static
    {
        $this->nomQuartier = $nomQuartier;

        return $this;
    }

    public function getNumRue(): ?int
    {
        return $this->numRue;
    }

    public function setNumRue(?int $numRue): static
    {
        $this->numRue = $numRue;

        return $this;
    }

    public function getCodePost(): ?string
    {
        return $this->codePost;
    }

    public function setCodePost(?string $codePost): static
    {
        $this->codePost = $codePost;

        return $this;
    }

    public function getLocalQ(): ?string
    {
        return $this->localQ;
    }

    public function setLocalQ(?string $localQ): static
    {
        $this->localQ = $localQ;

        return $this;
    }

    public function getVille(): ?Ville
    {
        return $this->ville;
    }

    public function setVille(?Ville $ville): static
    {
        $this->ville = $ville;

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
            $propriete->setQuartier($this);
        }

        return $this;
    }

    public function removePropriete(Propriete $propriete): static
    {
        if ($this->proprietes->removeElement($propriete)) {
            // set the owning side to null (unless already changed)
            if ($propriete->getQuartier() === $this) {
                $propriete->setQuartier(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->nomQuartier;
    }
}
