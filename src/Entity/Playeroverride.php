<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Playeroverride
 *
 * @ORM\Table(name="playeroverride", indexes={@ORM\Index(name="season", columns={"season"})})
 * @ORM\Entity
 */
class Playeroverride
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
     * @ORM\Column(name="teamid", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $teamid;

    /**
     * @var string
     *
     * @ORM\Column(name="pos", type="string", length=2, nullable=false)
     */
    private $pos;

    public function getPlayerid(): ?int
    {
        return $this->playerid;
    }

    public function getSeason(): ?\DateTimeInterface
    {
        return $this->season;
    }

    public function getTeamid(): ?int
    {
        return $this->teamid;
    }

    public function getPos(): ?string
    {
        return $this->pos;
    }

    public function setPos(string $pos): self
    {
        $this->pos = $pos;

        return $this;
    }


}
