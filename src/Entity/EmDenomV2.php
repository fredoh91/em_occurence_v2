<?php

namespace App\Entity;

use App\Repository\EmDenomV2Repository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EmDenomV2Repository::class)
 */
class EmDenomV2
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
    private $Denomination;

    /**
     * @ORM\Column(type="integer")
     */
    private $Nbr;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDenomination(): ?string
    {
        return $this->Denomination;
    }

    public function setDenomination(string $Denomination): self
    {
        $this->Denomination = $Denomination;

        return $this;
    }

    public function getNbr(): ?int
    {
        return $this->Nbr;
    }

    public function setNbr(int $Nbr): self
    {
        $this->Nbr = $Nbr;

        return $this;
    }
}
