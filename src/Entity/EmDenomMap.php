<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EmDenomMap
 *
 * @ORM\Table(name="em_denom_map")
 * @ORM\Entity
 */
class EmDenomMap
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
     * @ORM\Column(name="denomination", type="string", length=255, nullable=true)
     */
    private $denomination;

    /**
     * @var string|null
     *
     * @ORM\Column(name="CIS", type="string", length=8, nullable=true)
     */
    private $cis;

    /**
     * @var string|null
     *
     * @ORM\Column(name="label", type="string", length=255, nullable=true)
     */
    private $label;

    /**
     * @var string|null
     *
     * @ORM\Column(name="BNlabel", type="string", length=59, nullable=true)
     */
    private $bnlabel;

    /**
     * @var string|null
     *
     * @ORM\Column(name="ATC7", type="string", length=7, nullable=true)
     */
    private $atc7;

    /**
     * @var string|null
     *
     * @ORM\Column(name="Similarity", type="string", length=11, nullable=true)
     */
    private $similarity;

    /**
     * @var string|null
     *
     * @ORM\Column(name="CQ", type="string", length=4, nullable=true)
     */
    private $cq;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDenomination(): ?string
    {
        return $this->denomination;
    }

    public function setDenomination(?string $denomination): self
    {
        $this->denomination = $denomination;

        return $this;
    }

    public function getCis(): ?string
    {
        return $this->cis;
    }

    public function setCis(?string $cis): self
    {
        $this->cis = $cis;

        return $this;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(?string $label): self
    {
        $this->label = $label;

        return $this;
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

    public function getAtc7(): ?string
    {
        return $this->atc7;
    }

    public function setAtc7(?string $atc7): self
    {
        $this->atc7 = $atc7;

        return $this;
    }

    public function getSimilarity(): ?string
    {
        return $this->similarity;
    }

    public function setSimilarity(?string $similarity): self
    {
        $this->similarity = $similarity;

        return $this;
    }

    public function getCq(): ?string
    {
        return $this->cq;
    }

    public function setCq(?string $cq): self
    {
        $this->cq = $cq;

        return $this;
    }


}
