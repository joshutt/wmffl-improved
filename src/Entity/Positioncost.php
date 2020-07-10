<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Positioncost
 *
 * @ORM\Table(name="positioncost")
 * @ORM\Entity
 */
class Positioncost
{
    /**
     * @var string
     *
     * @ORM\Column(name="position", type="string", length=2, nullable=false, options={"default"="''","fixed"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $position = '\'\'';

    /**
     * @var int
     *
     * @ORM\Column(name="years", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $years = '0';

    /**
     * @var int|null
     *
     * @ORM\Column(name="cost", type="integer", nullable=true)
     */
    private $cost = '0';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="startSeason", type="date", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $startseason;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="endSeason", type="date", nullable=true, options={"default"="NULL"})
     */
    private $endseason = 'NULL';

    public function getPosition(): ?string
    {
        return $this->position;
    }

    public function getYears(): ?int
    {
        return $this->years;
    }

    public function getCost(): ?int
    {
        return $this->cost;
    }

    public function setCost(?int $cost): self
    {
        $this->cost = $cost;

        return $this;
    }

    public function getStartseason(): ?\DateTimeInterface
    {
        return $this->startseason;
    }

    public function getEndseason(): ?\DateTimeInterface
    {
        return $this->endseason;
    }

    public function setEndseason(?\DateTimeInterface $endseason): self
    {
        $this->endseason = $endseason;

        return $this;
    }


}
