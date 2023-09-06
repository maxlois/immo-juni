<?php

namespace App\Entity;

use App\Repository\TypeProprieteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TypeProprieteRepository::class)]
class TypePropriete
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $typeBase = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $descTyp = null;

    #[ORM\OneToMany(mappedBy: 'typePropriete', targetEntity: Propriete::class)]
    private Collection $proprietes;

    #[ORM\Column(length: 255)]
    private ?string $nomType = null;

    public function __construct()
    {
        $this->proprietes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }


    public function getTypeBase(): ?bool
    {
        return $this->typeBase;
    }

    public function setTypeBase(bool $typeBase): static
    {
        $this->typeBase = $typeBase;

        return $this;
    }

    public function getDescTyp(): ?string
    {
        return $this->descTyp;
    }

    public function setDescTyp(string $descTyp): static
    {
        $this->descTyp = $descTyp;

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
            $propriete->setTypePropriete($this);
        }

        return $this;
    }

    public function removePropriete(Propriete $propriete): static
    {
        if ($this->proprietes->removeElement($propriete)) {
            // set the owning side to null (unless already changed)
            if ($propriete->getTypePropriete() === $this) {
                $propriete->setTypePropriete(null);
            }
        }

        return $this;
    }


    public function getNomType(): ?string
    {
        return $this->nomType;
    }

    public function setNomType(string $nomType): static
    {
        $this->nomType = $nomType;

        return $this;
    }

}
