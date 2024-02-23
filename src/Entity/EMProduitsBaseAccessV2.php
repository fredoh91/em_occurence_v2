<?php

namespace App\Entity;

use App\Repository\EMProduitsBaseAccessV2Repository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EMProduitsBaseAccessV2Repository::class)]
#[ORM\Table(name:"em_produits_base_access_v2")]

class EMProduitsBaseAccessV2
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Denomination = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $DCI = null;

    #[ORM\Column(length: 255)]
    private ?string $idCas = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Dosage = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Voie = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $codeVU = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $codeATC = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $libATC = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $numeroCRPV = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDenomination(): ?string
    {
        return $this->Denomination;
    }

    public function setDenomination(?string $Denomination): static
    {
        $this->Denomination = $Denomination;

        return $this;
    }

    public function getDCI(): ?string
    {
        return $this->DCI;
    }

    public function setDCI(?string $DCI): static
    {
        $this->DCI = $DCI;

        return $this;
    }

    public function getIdCas(): ?string
    {
        return $this->idCas;
    }

    public function setIdCas(string $idCas): static
    {
        $this->idCas = $idCas;

        return $this;
    }

    public function getDosage(): ?string
    {
        return $this->Dosage;
    }

    public function setDosage(?string $Dosage): static
    {
        $this->Dosage = $Dosage;

        return $this;
    }

    public function getVoie(): ?string
    {
        return $this->Voie;
    }

    public function setVoie(?string $Voie): static
    {
        $this->Voie = $Voie;

        return $this;
    }

    public function getCodeVU(): ?string
    {
        return $this->codeVU;
    }

    public function setCodeVU(?string $codeVU): static
    {
        $this->codeVU = $codeVU;

        return $this;
    }

    public function getCodeATC(): ?string
    {
        return $this->codeATC;
    }

    public function setCodeATC(?string $codeATC): static
    {
        $this->codeATC = $codeATC;

        return $this;
    }

    public function getLibATC(): ?string
    {
        return $this->libATC;
    }

    public function setLibATC(?string $libATC): static
    {
        $this->libATC = $libATC;

        return $this;
    }

    public function getNumeroCRPV(): ?string
    {
        return $this->numeroCRPV;
    }

    public function setNumeroCRPV(?string $numeroCRPV): static
    {
        $this->numeroCRPV = $numeroCRPV;

        return $this;
    }
}
