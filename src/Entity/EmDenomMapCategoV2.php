<?php

namespace App\Entity;

use App\Repository\EmDenomMapCategoV2Repository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EmDenomMapCategoV2Repository::class)]
class EmDenomMapCategoV2
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $Type;

    #[ORM\Column(type: 'string', length: 255)]
    private $Categorie;

    #[ORM\OneToMany(targetEntity: EmDenomMapTodoV2::class, mappedBy: 'Categorie')]
    private $emDenomMapTodoV2s;

    #[ORM\OneToMany(targetEntity: EmDenomMapV2::class, mappedBy: 'Categorie')]
    private $emDenomMapV2s;

    public function __construct()
    {
        $this->emDenomMapTodoV2s = new ArrayCollection();
        $this->emDenomMapV2s = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->Type;
    }

    public function setType(?string $Type): self
    {
        $this->Type = $Type;

        return $this;
    }

    public function getCategorie(): ?string
    {
        return $this->Categorie;
    }

    public function setCategorie(string $Categorie): self
    {
        $this->Categorie = $Categorie;

        return $this;
    }

    /**
     * @return Collection|EmDenomMapTodoV2[]
     */
    public function getEmDenomMapTodoV2s(): Collection
    {
        return $this->emDenomMapTodoV2s;
    }

    public function addEmDenomMapTodoV2(EmDenomMapTodoV2 $emDenomMapTodoV2): self
    {
        if (!$this->emDenomMapTodoV2s->contains($emDenomMapTodoV2)) {
            $this->emDenomMapTodoV2s[] = $emDenomMapTodoV2;
            $emDenomMapTodoV2->setCategorie($this);
        }

        return $this;
    }

    public function removeEmDenomMapTodoV2(EmDenomMapTodoV2 $emDenomMapTodoV2): self
    {
        if ($this->emDenomMapTodoV2s->contains($emDenomMapTodoV2)) {
            $this->emDenomMapTodoV2s->removeElement($emDenomMapTodoV2);
            // set the owning side to null (unless already changed)
            if ($emDenomMapTodoV2->getCategorie() === $this) {
                $emDenomMapTodoV2->setCategorie(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|EmDenomMapV2[]
     */
    public function getEmDenomMapV2s(): Collection
    {
        return $this->emDenomMapV2s;
    }

    public function addEmDenomMapV2(EmDenomMapV2 $emDenomMapV2): self
    {
        if (!$this->emDenomMapV2s->contains($emDenomMapV2)) {
            $this->emDenomMapV2s[] = $emDenomMapV2;
            $emDenomMapV2->setCategorie($this);
        }

        return $this;
    }

    public function removeEmDenomMapV2(EmDenomMapV2 $emDenomMapV2): self
    {
        if ($this->emDenomMapV2s->contains($emDenomMapV2)) {
            $this->emDenomMapV2s->removeElement($emDenomMapV2);
            // set the owning side to null (unless already changed)
            if ($emDenomMapV2->getCategorie() === $this) {
                $emDenomMapV2->setCategorie(null);
            }
        }

        return $this;
    }
}
