<?php

namespace App\Entity;

use App\Repository\EmOccProduitV2Repository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EmOccProduitV2Repository::class)]
class EmOccProduitV2
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $produit;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $Nbr;

    #[ORM\ManyToOne(targetEntity: GrilleOccEmV2::class, inversedBy: 'emOccProduitV2s')]
    #[ORM\JoinColumn(nullable: false)]
    private $CatGrille;

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

    public function getCatGrille(): ?GrilleOccEmV2
    {
        return $this->CatGrille;
    }

    public function setCatGrille(?GrilleOccEmV2 $CatGrille): self
    {
        $this->CatGrille = $CatGrille;

        return $this;
    }
}
