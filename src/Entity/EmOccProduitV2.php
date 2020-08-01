<?php

namespace App\Entity;

use App\Repository\EmOccProduitV2Repository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EmOccProduitV2Repository::class)
 */
class EmOccProduitV2
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $produit;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $Nbr;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProduit(): ?string
    {
        return $this->produit;
    }

    public function setProduit(?string $produit): self
    {
        $this->produit = $produit;

        return $this;
    }

    public function getNbr(): ?int
    {
        return $this->Nbr;
    }

    public function setNbr(?int $Nbr): self
    {
        $this->Nbr = $Nbr;

        return $this;
    }
}
