<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OnlyfreqDeno
 *
 * @ORM\Table(name="onlyfreq_deno")
 * @ORM\Entity
 */
class OnlyfreqDeno
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
     * @ORM\Column(name="denomination", type="string", length=262, nullable=true)
     */
    private $denomination;

    /**
     * @var string|null
     *
     * @ORM\Column(name="BNlabel", type="string", length=46, nullable=true)
     */
    private $bnlabel;

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

    public function getDenomination(): ?string
    {
        return $this->denomination;
    }

    public function setDenomination(?string $denomination): self
    {
        $this->denomination = $denomination;

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
