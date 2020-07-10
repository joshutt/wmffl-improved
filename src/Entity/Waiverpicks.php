<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Waiverpicks
 *
 * @ORM\Table(name="waiverpicks")
 * @ORM\Entity
 */
class Waiverpicks
{
    /**
     * @var int
     *
     * @ORM\Column(name="teamid", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $teamid = '0';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="season", type="date", nullable=false, options={"default"="0000"})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $season = '0000';

    /**
     * @var int
     *
     * @ORM\Column(name="week", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $week = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="priority", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $priority = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="playerid", type="integer", nullable=false)
     */
    private $playerid = '0';

    public function getTeamid(): ?int
    {
        return $this->teamid;
    }

    public function getSeason(): ?\DateTimeInterface
    {
        return $this->season;
    }

    public function getWeek(): ?int
    {
        return $this->week;
    }

    public function getPriority(): ?int
    {
        return $this->priority;
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
