<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RechercheRepository")
 */
class Recherche
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TypeLogement", inversedBy="recherches")
     * @ORM\JoinColumn(nullable=false)
     */
    private $typeLogement;


    /**
     * @ORM\Column(type="integer")
     */
    private $nombrePiece;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Localisation", inversedBy="recherches")
     * @ORM\JoinColumn(nullable=false)
     */
    private $localisation;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $prix;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $surfaceTotale;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Vente", inversedBy="recherches")
     */
    private $nomVente;


    public function getId(): ?int
    {
        return $this->id;
    }


    public function getTypeLogement(): ?TypeLogement
    {
        return $this->typeLogement;
    }

    public function setTypeLogement(?TypeLogement $typeLogement): self
    {
        $this->typeLogement = $typeLogement;

        return $this;
    }

    public function getNombrePiece(): ?int
    {
        return $this->nombrePiece;
    }

    public function setNombrePiece(int $nombrePiece): self
    {
        $this->nombrePiece = $nombrePiece;

        return $this;
    }

    public function getLocalisation(): ?Localisation
    {
        return $this->localisation;
    }

    public function setLocalisation(?Localisation $localisation): self
    {
        $this->localisation = $localisation;

        return $this;
    }

    public function getPrix(): ?string
    {
        return $this->prix;
    }

    public function setPrix(string $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getSurfaceTotale(): ?string
    {
        return $this->surfaceTotale;
    }

    public function setSurfaceTotale(string $surfaceTotale): self
    {
        $this->surfaceTotale = $surfaceTotale;

        return $this;
    }

    public function getNomVente(): ?Vente
    {
        return $this->nomVente;
    }

    public function setNomVente(?Vente $nomVente): self
    {
        $this->nomVente = $nomVente;

        return $this;
    }






}
