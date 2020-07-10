<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Expansionpicks
 *
 * @ORM\Table(name="expansionpicks")
 * @ORM\Entity
 */
class Expansionpicks
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
     * @var int
     *
     * @ORM\Column(name="playerid", type="integer", nullable=false)
     */
    private $playerid;

    /**
     * @var int
     *
     * @ORM\Column(name="teamid", type="integer", nullable=false)
     */
    private $teamid;

    /**
     * @var int
     *
     * @ORM\Column(name="round", type="integer", nullable=false)
     */
    private $round;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getTeamid(): ?int
    {
        return $this->teamid;
    }

    public function setTeamid(int $teamid): self
    {
        $this->teamid = $teamid;

        return $this;
    }

    public function getRound(): ?int
    {
        return $this->round;
    }

    public function setRound(int $round): self
    {
        $this->round = $round;

        return $this;
    }


}
