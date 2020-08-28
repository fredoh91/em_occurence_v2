<?php

namespace App\Entity;

use App\Repository\EmRomediV2Repository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EmRomediV2Repository::class)
 */
class EmRomediV2
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $CIS;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Label;

    /**
     * @ORM\Column(type="string", length=255)
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

    public function getCIS(): ?string
    {
        return $this->CIS;
    }

    public function setCIS(?string $CIS): self
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

    public function getBNLabelRomedi(): ?string
    {
        return $this->BN_Label_Romedi;
    }

    public function setBNLabelRomedi(string $BN_Label_Romedi): self
    {
        $this->BN_Label_Romedi = $BN_Label_Romedi;

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
    public function __toString() {
        return $this->BN_Label_Romedi;
    }
}
