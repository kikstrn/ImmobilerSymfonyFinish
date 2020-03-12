<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LocalisationRepository")
 */
class Localisation
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nomLocalisation;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Logement", mappedBy="localisation")
     */
    private $logements;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Recherche", mappedBy="localisation")
     */
    private $recherches;

    public function __construct()
    {
        $this->logements = new ArrayCollection();
        $this->recherches = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomLocalisation(): ?string
    {
        return $this->nomLocalisation;
    }

    public function setNomLocalisation(string $nomLocalisation): self
    {
        $this->nomLocalisation = $nomLocalisation;

        return $this;
    }

    /**
     * @return Collection|Logement[]
     */
    public function getLogements(): Collection
    {
        return $this->logements;
    }

    public function addLogement(Logement $logement): self
    {
        if (!$this->logements->contains($logement)) {
            $this->logements[] = $logement;
            $logement->setLocalisation($this);
        }

        return $this;
    }

    public function removeLogement(Logement $logement): self
    {
        if ($this->logements->contains($logement)) {
            $this->logements->removeElement($logement);
            // set the owning side to null (unless already changed)
            if ($logement->getLocalisation() === $this) {
                $logement->setLocalisation(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Recherche[]
     */
    public function getRecherches(): Collection
    {
        return $this->recherches;
    }

    public function addRecherch(Recherche $recherch): self
    {
        if (!$this->recherches->contains($recherch)) {
            $this->recherches[] = $recherch;
            $recherch->setLocalisation($this);
        }

        return $this;
    }

    public function removeRecherch(Recherche $recherch): self
    {
        if ($this->recherches->contains($recherch)) {
            $this->recherches->removeElement($recherch);
            // set the owning side to null (unless already changed)
            if ($recherch->getLocalisation() === $this) {
                $recherch->setLocalisation(null);
            }
        }

        return $this;
    }
}
