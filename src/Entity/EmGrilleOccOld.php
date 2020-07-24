<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EmGrilleOccOld
 *
 * @ORM\Table(name="em_grille_occ_old")
 * @ORM\Entity
 */
class EmGrilleOccOld
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
     * @var string
     *
     * @ORM\Column(name="cat_lib", type="text", length=65535, nullable=false)
     */
    private $catLib;

    /**
     * @var int
     *
     * @ORM\Column(name="cat_idx", type="integer", nullable=false)
     */
    private $catIdx;

    /**
     * @var int
     *
     * @ORM\Column(name="vmin", type="integer", nullable=false)
     */
    private $vmin;

    /**
     * @var int
     *
     * @ORM\Column(name="vmax", type="integer", nullable=false)
     */
    private $vmax;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCatLib(): ?string
    {
        return $this->catLib;
    }

    public function setCatLib(string $catLib): self
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
