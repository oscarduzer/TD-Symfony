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

    #[ORM\Column]
    private ?int $idVille = null;

    #[ORM\Column(length: 140)]
    private ?string $nomVille = null;

    #[ORM\OneToMany(targetEntity: Marche::class, mappedBy: 'idVille')]
    private Collection $marches;

    public function __construct()
    {
        $this->marches = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdVille(): ?int
    {
        return $this->idVille;
    }

    public function setIdVille(int $idVille): static
    {
        $this->idVille = $idVille;

        return $this;
    }

    public function getNomVille(): ?string
    {
        return $this->nomVille;
    }

    public function setNomVille(string $nomVille): static
    {
        $this->nomVille = $nomVille;

        return $this;
    }

    /**
     * @return Collection<int, Marche>
     */
    public function getMarches(): Collection
    {
        return $this->marches;
    }

    public function addMarch(Marche $march): static
    {
        if (!$this->marches->contains($march)) {
            $this->marches->add($march);
            $march->setIdVille($this);
        }

        return $this;
    }

    public function removeMarch(Marche $march): static
    {
        if ($this->marches->removeElement($march)) {
            // set the owning side to null (unless already changed)
            if ($march->getIdVille() === $this) {
                $march->setIdVille(null);
            }
        }

        return $this;
    }
}
