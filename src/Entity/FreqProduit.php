<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FreqProduit
 *
 * @ORM\Table(name="freq_produit")
 * @ORM\Entity
 */
class FreqProduit
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string|null
     *
     * @ORM\Column(name="BNlabel", type="string", length=46, nullable=true)
     */
    private $bnlabel;

    /**
     * @var string|null
     *
     * @ORM\Column(name="natureErreur", type="string", length=53, nullable=true)
     */
    private $natureerreur;

    /**
     * @var int|null
     *
     * @ORM\Column(name="Nbr", type="integer", nullable=true)
     */
    private $nbr;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBnlabel(): ?string
    {
        return $this->bnlabel;
    }

    public function setBnlabel(?string $bnlabel): self
    {
        $this->bnlabel = $bnlabel;

        return $this;
    }

    public function getNatureerreur(): ?string
    {
        return $this->natureerreur;
    }

    public function setNatureerreur(?string $natureerreur): self
    {
        $this->natureerreur = $natureerreur;

        return $this;
    }

    public function getNbr(): ?int
    {
        return $this->nbr;
    }

    public function setNbr(?int $nbr): self
    {
        $this->nbr = $nbr;

        return $this;
    }


}
