<?php

namespace App\Entity;

use App\Repository\GrilleOccEmV2Repository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GrilleOccEmV2Repository::class)]
class GrilleOccEmV2
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $cat_lib;

    #[ORM\Column(type: 'integer', nullable: false)]
    private $cat_idx;

    #[ORM\Column(type: 'integer', nullable: false)]
    private $vmin;

    #[ORM\Column(type: 'integer', nullable: false)]
    private $vmax;

    #[ORM\OneToMany(targetEntity: EmOccProduitV2::class, mappedBy: 'CatGrille')]
    private $emOccProduitV2s;

    public function __construct()
    {
        $this->emOccProduitV2s = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCatLib(): ?string
    {
        return $this->cat_lib;
    }

    public function setCatLib(string $cat_lib): self
    {
        $this->cat_lib = $cat_lib;

        return $this;
    }

    public function getCatIdx(): ?int
    {
        return $this->cat_idx;
    }

    public function setCatIdx(?int $cat_idx): self
    {
        $this->cat_idx = $cat_idx;

        return $this;
    }

    public function getVmin(): ?int
    {
        return $this->vmin;
    }

    public function setVmin(?int $vmin): self
    {
        $this->vmin = $vmin;

        return $this;
    }

    public function getVmax(): ?int
    {
        return $this->vmax;
    }

    public function setVmax(?int $vmax): self
    {
        $this->vmax = $vmax;

        return $this;
    }

    /**
     * @return Collection|EmOccProduitV2[]
     */
    public function getEmOccProduitV2s(): Collection
    {
        return $this->emOccProduitV2s;
    }

    public function addEmOccProduitV2(EmOccProduitV2 $emOccProduitV2): self
    {
        if (!$this->emOccProduitV2s->contains($emOccProduitV2)) {
            $this->emOccProduitV2s[] = $emOccProduitV2;
            $emOccProduitV2->setCatGrille($this);
        }

        return $this;
    }

    public function removeEmOccProduitV2(EmOccProduitV2 $emOccProduitV2): self
    {
        if ($this->emOccProduitV2s->contains($emOccProduitV2)) {
            $this->emOccProduitV2s->removeElement($emOccProduitV2);
            // set the owning side to null (unless already changed)
            if ($emOccProduitV2->getCatGrille() === $this) {
                $emOccProduitV2->setCatGrille(null);
            }
        }

        return $this;
    }
}
