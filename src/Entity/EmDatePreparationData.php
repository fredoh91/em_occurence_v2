<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EmDatePreparationData
 *
 * @ORM\Table(name="em_date_preparation_data")
 * @ORM\Entity
 */
class EmDatePreparationData
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
     * @var \DateTime
     *
     * @ORM\Column(name="date_preparation_data", type="datetime", nullable=false, options={"default"="CURRENT_TIMESTAMP"})
     */
    private $datePreparationData = 'CURRENT_TIMESTAMP';

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDatePreparationData(): ?\DateTimeInterface
    {
        return $this->datePreparationData;
    }

    public function setDatePreparationData(\DateTimeInterface $datePreparationData): self
    {
        $this->datePreparationData = $datePreparationData;

        return $this;
    }


}
