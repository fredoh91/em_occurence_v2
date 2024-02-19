<?php

namespace App\Entity;

use App\Repository\EmDenomLstNumBNPVV2Repository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EmDenomLstNumBNPVV2Repository::class)]
class EmDenomLstNumBNPVV2
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $denomination = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $lst_numBNPV = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDenomination(): ?string
    {
        return $this->denomination;
    }

    public function setDenomination(?string $denomination): static
    {
        $this->denomination = $denomination;

        return $this;
    }

    public function getLstNumBNPV(): ?string
    {
        return $this->lst_numBNPV;
    }

    public function setLstNumBNPV(?string $lst_numBNPV): static
    {
        $this->lst_numBNPV = $lst_numBNPV;

        return $this;
    }
}
