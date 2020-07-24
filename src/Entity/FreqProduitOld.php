<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FreqProduitOld
 *
 * @ORM\Table(name="freq_produit_old")
 * @ORM\Entity
 */
class FreqProduitOld
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

    /**
     * @var int|null
     *
     * @ORM\Column(name="Cumul", type="integer", nullable=true)
     */
    private $cumul;

    /**
     * @var string|null
     *
     * @ORM\Column(name="Cumul_pct", type="string", length=4, nullable=true)
     */
    private $cumulPct;

    /**
     * @var int|null
     *
     * @ORM\Column(name="Cat", type="integer", nullable=true)
     */
    private $cat;

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

    public function getCumul(): ?int
    {
        return $this->cumul;
    }

    public function setCumul(?int $cumul): self
    {
        $this->cumul = $cumul;

        return $this;
    }

    public function getCumulPct(): ?string
    {
        return $this->cumulPct;
    }

    public function setCumulPct(?string $cumulPct): self
    {
        $this->cumulPct = $cumulPct;

        return $this;
    }

    public function getCat(): ?int
    {
        return $this->cat;
    }

    public function setCat(?int $cat): self
    {
        $this->cat = $cat;

        return $this;
    }


}
