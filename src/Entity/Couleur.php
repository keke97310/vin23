<?php

namespace App\Entity;

use App\Repository\CouleurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CouleurRepository::class)]
class Couleur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'couleur', targetEntity: Vin::class, orphanRemoval: true)]
    private Collection $vins;

    public function __construct()
    {
        $this->vins = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, Vin>
     */
    public function getVins(): Collection
    {
        return $this->vins;
    }

    public function addVin(Vin $vin): static
    {
        if (!$this->vins->contains($vin)) {
            $this->vins->add($vin);
            $vin->setCouleur($this);
        }

        return $this;
    }

    public function removeVin(Vin $vin): static
    {
        if ($this->vins->removeElement($vin)) {
            // set the owning side to null (unless already changed)
            if ($vin->getCouleur() === $this) {
                $vin->setCouleur(null);
            }
        }

        return $this;
    }
}
