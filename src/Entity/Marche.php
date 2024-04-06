<?php

namespace App\Entity;

use App\Repository\MarcheRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MarcheRepository::class)]
class Marche
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $idMarche = null;

    #[ORM\Column(length: 140)]
    private ?string $nomMarche = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column]
    private ?int $capacite = null;

    #[ORM\Column(length: 150)]
    private ?string $adresse = null;

    #[ORM\Column(length: 40)]
    private ?string $telephone = null;

    #[ORM\Column(length: 170)]
    private ?string $image = null;

    #[ORM\ManyToOne(inversedBy: 'marches')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Ville $idVille = null;

    #[ORM\OneToMany(targetEntity: Emplacement::class, mappedBy: 'idMarche')]
    private Collection $emplacements;

    public function __construct()
    {
        $this->emplacements = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdMarche(): ?int
    {
        return $this->idMarche;
    }

    public function setIdMarche(int $idMarche): static
    {
        $this->idMarche = $idMarche;

        return $this;
    }

    public function getNomMarche(): ?string
    {
        return $this->nomMarche;
    }

    public function setNomMarche(string $nomMarche): static
    {
        $this->nomMarche = $nomMarche;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getCapacite(): ?int
    {
        return $this->capacite;
    }

    public function setCapacite(int $capacite): static
    {
        $this->capacite = $capacite;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): static
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): static
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function getIdVille(): ?Ville
    {
        return $this->idVille;
    }

    public function setIdVille(?Ville $idVille): static
    {
        $this->idVille = $idVille;

        return $this;
    }

    /**
     * @return Collection<int, Emplacement>
     */
    public function getEmplacements(): Collection
    {
        return $this->emplacements;
    }

    public function addEmplacement(Emplacement $emplacement): static
    {
        if (!$this->emplacements->contains($emplacement)) {
            $this->emplacements->add($emplacement);
            $emplacement->setIdMarche($this);
        }

        return $this;
    }

    public function removeEmplacement(Emplacement $emplacement): static
    {
        if ($this->emplacements->removeElement($emplacement)) {
            // set the owning side to null (unless already changed)
            if ($emplacement->getIdMarche() === $this) {
                $emplacement->setIdMarche(null);
            }
        }

        return $this;
    }
}
