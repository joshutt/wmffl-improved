<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Waiveraward
 *
 * @ORM\Table(name="waiveraward")
 * @ORM\Entity
 */
class Waiveraward
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="season", type="date", nullable=false, options={"default"="0000"})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $season = '0000';

    /**
     * @var bool
     *
     * @ORM\Column(name="week", type="boolean", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $week = '0';

    /**
     * @var bool
     *
     * @ORM\Column(name="pick", type="boolean", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $pick = '0';

    /**
     * @var bool
     *
     * @ORM\Column(name="teamid", type="boolean", nullable=false)
     */
    private $teamid = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="playerid", type="integer", nullable=false)
     */
    private $playerid = '0';

    public function getSeason(): ?\DateTimeInterface
    {
        return $this->season;
    }

    public function getWeek(): ?bool
    {
        return $this->week;
    }

    public function getPick(): ?bool
    {
        return $this->pick;
    }

    public function getTeamid(): ?bool
    {
        return $this->teamid;
    }

    public function setTeamid(bool $teamid): self
    {
        $this->teamid = $teamid;

        return $this;
    }

    public function getPlayerid(): ?int
    {
        return $this->playerid;
    }

    public function setPlayerid(int $playerid): self
    {
        $this->playerid = $playerid;

        return $this;
    }


}
