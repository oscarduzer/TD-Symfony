<?php

namespace App\Entity;

use App\Repository\EmplacementRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EmplacementRepository::class)]
class Emplacement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $idEmplacement = null;

    #[ORM\Column(length: 160)]
    private ?string $numero = null;

    #[ORM\ManyToOne(inversedBy: 'emplacements')]
    private ?Marche $idMarche = null;

    #[ORM\ManyToOne(inversedBy: 'Emplacement')]
    #[ORM\JoinColumn(nullable: false)]
    private ?TypeEmplacement $typeEmplacement = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdEmplacement(): ?int
    {
        return $this->idEmplacement;
    }

    public function setIdEmplacement(int $idEmplacement): static
    {
        $this->idEmplacement = $idEmplacement;

        return $this;
    }

    public function getNumero(): ?string
    {
        return $this->numero;
    }

    public function setNumero(string $numero): static
    {
        $this->numero = $numero;

        return $this;
    }

    public function getIdMarche(): ?Marche
    {
        return $this->idMarche;
    }

    public function setIdMarche(?Marche $idMarche): static
    {
        $this->idMarche = $idMarche;

        return $this;
    }

    public function getTypeEmplacement(): ?TypeEmplacement
    {
        return $this->typeEmplacement;
    }

    public function setTypeEmplacement(?TypeEmplacement $typeEmplacement): static
    {
        $this->typeEmplacement = $typeEmplacement;

        return $this;
    }
}
