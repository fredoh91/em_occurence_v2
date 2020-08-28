<?php

namespace App\Entity;

use App\Repository\EmDenomMapTodoV2Repository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EmDenomMapTodoV2Repository::class)
 */
class EmDenomMapTodoV2
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

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $CIS;

    /**
     * @ORM\Column(type="text", length=255, nullable=true)
     */
    private $Label;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $BN_Label;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $BN_Label_Romedi;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ATC7;

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

    public function getCIS(): ?string
    {
        return $this->CIS;
    }

    public function setCIS(string $CIS): self
    {
        $this->CIS = $CIS;

        return $this;
    }

    public function getLabel(): ?string
    {
        return $this->Label;
    }

    public function setLabel(?string $Label): self
    {
        $this->Label = $Label;

        return $this;
    }

    public function getBNLabel(): ?string
    {
        return $this->BN_Label;
    }

    public function setBNLabel(?string $BN_Label): self
    {
        $this->BN_Label = $BN_Label;

        return $this;
    }

    public function getATC7(): ?string
    {
        return $this->ATC7;
    }

    public function setATC7(?string $ATC7): self
    {
        $this->ATC7 = $ATC7;

        return $this;
    }

    public function getBNLabelRomedi(): ?string
    {
        return $this->BN_Label_Romedi;
    }

    public function setBNLabelRomedi(?string $BN_Label_Romedi): self
    {
        $this->BN_Label_Romedi = $BN_Label;

        return $this;
    }

}
