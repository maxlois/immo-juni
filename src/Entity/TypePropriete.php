<?php

namespace App\Entity;

use App\Repository\TypeProprieteRepository;
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
    private ? int $nombPiece = null;

    #[ORM\Column(length: 255)]
    private ?string $typeBase = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $descTyp = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombPiece(): ?int
    {
        return $this->nombPiece;
    }

    public function setNombPiece(int $nombPiece): static
    {
        $this->nombPiece = $nombPiece;

        return $this;
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
}
