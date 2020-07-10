<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Weeklyplayerscores
 *
 * @ORM\Table(name="weeklyplayerscores")
 * @ORM\Entity
 */
class Weeklyplayerscores
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
     * @var bool
     *
     * @ORM\Column(name="playerid", type="boolean", nullable=false)
     */
    private $playerid;

    /**
     * @var bool
     *
     * @ORM\Column(name="name", type="boolean", nullable=false)
     */
    private $name;

    /**
     * @var bool
     *
     * @ORM\Column(name="pos", type="boolean", nullable=false)
     */
    private $pos;

    /**
     * @var bool
     *
     * @ORM\Column(name="nflteam", type="boolean", nullable=false)
     */
    private $nflteam;

    /**
     * @var bool
     *
     * @ORM\Column(name="teamid", type="boolean", nullable=false)
     */
    private $teamid;

    /**
     * @var bool
     *
     * @ORM\Column(name="teamname", type="boolean", nullable=false)
     */
    private $teamname;

    /**
     * @var bool
     *
     * @ORM\Column(name="season", type="boolean", nullable=false)
     */
    private $season;

    /**
     * @var bool
     *
     * @ORM\Column(name="week", type="boolean", nullable=false)
     */
    private $week;

    /**
     * @var bool
     *
     * @ORM\Column(name="pts", type="boolean", nullable=false)
     */
    private $pts;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPlayerid(): ?bool
    {
        return $this->playerid;
    }

    public function setPlayerid(bool $playerid): self
    {
        $this->playerid = $playerid;

        return $this;
    }

    public function getName(): ?bool
    {
        return $this->name;
    }

    public function setName(bool $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getPos(): ?bool
    {
        return $this->pos;
    }

    public function setPos(bool $pos): self
    {
        $this->pos = $pos;

        return $this;
    }

    public function getNflteam(): ?bool
    {
        return $this->nflteam;
    }

    public function setNflteam(bool $nflteam): self
    {
        $this->nflteam = $nflteam;

        return $this;
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

    public function getTeamname(): ?bool
    {
        return $this->teamname;
    }

    public function setTeamname(bool $teamname): self
    {
        $this->teamname = $teamname;

        return $this;
    }

    public function getSeason(): ?bool
    {
        return $this->season;
    }

    public function setSeason(bool $season): self
    {
        $this->season = $season;

        return $this;
    }

    public function getWeek(): ?bool
    {
        return $this->week;
    }

    public function setWeek(bool $week): self
    {
        $this->week = $week;

        return $this;
    }

    public function getPts(): ?bool
    {
        return $this->pts;
    }

    public function setPts(bool $pts): self
    {
        $this->pts = $pts;

        return $this;
    }


}
