<?php

namespace App\Entity;

use App\Repository\TypeEmplacementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TypeEmplacementRepository::class)]
class TypeEmplacement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $idType = null;

    #[ORM\Column(length: 160)]
    private ?string $libelle = null;

    #[ORM\OneToMany(targetEntity: Emplacement::class, mappedBy: 'typeEmplacement')]
    private Collection $Emplacement;

    public function __construct()
    {
        $this->Emplacement = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdType(): ?int
    {
        return $this->idType;
    }

    public function setIdType(int $idType): static
    {
        $this->idType = $idType;

        return $this;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): static
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * @return Collection<int, Emplacement>
     */
    public function getEmplacement(): Collection
    {
        return $this->Emplacement;
    }

    public function addEmplacement(Emplacement $emplacement): static
    {
        if (!$this->Emplacement->contains($emplacement)) {
            $this->Emplacement->add($emplacement);
            $emplacement->setTypeEmplacement($this);
        }

        return $this;
    }

    public function removeEmplacement(Emplacement $emplacement): static
    {
        if ($this->Emplacement->removeElement($emplacement)) {
            // set the owning side to null (unless already changed)
            if ($emplacement->getTypeEmplacement() === $this) {
                $emplacement->setTypeEmplacement(null);
            }
        }

        return $this;
    }
}
