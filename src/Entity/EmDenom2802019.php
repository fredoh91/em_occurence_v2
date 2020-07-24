<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EmDenom2802019
 *
 * @ORM\Table(name="em_denom_2802019")
 * @ORM\Entity
 */
class EmDenom2802019
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
