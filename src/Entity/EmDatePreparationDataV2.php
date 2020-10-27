<?php

namespace App\Entity;

use App\Repository\EmDatePreparationDataV2Repository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EmDatePreparationDataV2Repository::class)
 */
class EmDatePreparationDataV2
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $DatePreparationData;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDatePreparationData(): ?\DateTimeInterface
    {
        return $this->DatePreparationData;
    }

    public function setDatePreparationData(\DateTimeInterface $DatePreparationData): self
    {
        $this->DatePreparationData = $DatePreparationData;

        return $this;
    }
}
