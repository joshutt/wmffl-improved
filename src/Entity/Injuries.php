<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Injuries
 *
 * @ORM\Table(name="injuries", indexes={@ORM\Index(name="playerid", columns={"playerid"})})
 * @ORM\Entity
 */
class Injuries
{
    /**
     * @var int
     *
     * @ORM\Column(name="playerid", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $playerid;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="season", type="date", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $season;

    /**
     * @var int
     *
     * @ORM\Column(name="week", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $week;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=0, nullable=false)
     */
    private $status;

    /**
     * @var string|null
     *
     * @ORM\Column(name="details", type="string", length=50, nullable=true, options={"default"="NULL"})
     */
    private $details = 'NULL';

    public function getPlayerid(): ?int
    {
        return $this->playerid;
    }

    public function getSeason(): ?\DateTimeInterface
    {
        return $this->season;
    }

    public function getWeek(): ?int
    {
        return $this->week;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getDetails(): ?string
    {
        return $this->details;
    }

    public function setDetails(?string $details): self
    {
        $this->details = $details;

        return $this;
    }


}
