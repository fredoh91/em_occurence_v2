<?php

namespace App\Entity;

use App\Repository\EmGrilleOccV2Repository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EmGrilleOccV2Repository::class)]
class EmGrilleOccV2
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $catLib;

    #[ORM\Column(type: 'integer')]
    private $catIdx;

    #[ORM\Column(type: 'integer')]
    private $vmin;

    #[ORM\Column(type: 'integer')]
    private $vmax;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCatLib(): ?string
    {
        return $this->catLib;
    }

    public function setCatLib(?string $produit): self
    {
        $this->catLib = $catLib;

        return $this;
    }

    public function getCatIdx(): ?int
    {
        return $this->catIdx;
    }

    public function setCatIdx(int $catIdx): self
    {
        $this->catIdx = $catIdx;

        return $this;
    }

    public function getVmin(): ?int
    {
        return $this->vmin;
    }

    public function setVmin(int $vmin): self
    {
        $this->vmin = $vmin;

        return $this;
    }

    public function getVmax(): ?int
    {
        return $this->vmax;
    }

    public function setVmax(int $vmax): self
    {
        $this->vmax = $vmax;

        return $this;
    }

}
