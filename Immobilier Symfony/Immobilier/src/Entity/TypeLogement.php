<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TypeLogementRepository")
 */
class TypeLogement
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $nomTypeLogement;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Logement", mappedBy="typeLogement")
     */
    private $logements;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Recherche", mappedBy="typeLogement")
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

    public function getNomTypeLogement(): ?string
    {
        return $this->nomTypeLogement;
    }

    public function setNomTypeLogement(string $nomTypeLogement): self
    {
        $this->nomTypeLogement = $nomTypeLogement;

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
            $logement->setTypeLogement($this);
        }

        return $this;
    }

    public function removeLogement(Logement $logement): self
    {
        if ($this->logements->contains($logement)) {
            $this->logements->removeElement($logement);
            // set the owning side to null (unless already changed)
            if ($logement->getTypeLogement() === $this) {
                $logement->setTypeLogement(null);
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
            $recherch->setTypeLogement($this);
        }

        return $this;
    }

    public function removeRecherch(Recherche $recherch): self
    {
        if ($this->recherches->contains($recherch)) {
            $this->recherches->removeElement($recherch);
            // set the owning side to null (unless already changed)
            if ($recherch->getTypeLogement() === $this) {
                $recherch->setTypeLogement(null);
            }
        }

        return $this;
    }
}
