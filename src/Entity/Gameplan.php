<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Gameplan
 *
 * @ORM\Table(name="gameplan", uniqueConstraints={@ORM\UniqueConstraint(name="season", columns={"season", "week", "teamid", "side"})}, indexes={@ORM\Index(name="Season_Week_Team", columns={"season", "week", "teamid", "side"})})
 * @ORM\Entity
 */
class Gameplan
{
    /**
     * @var int
     *
     * @ORM\Column(name="gameplan_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $gameplanId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="season", type="date", nullable=false)
     */
    private $season;

    /**
     * @var int
     *
     * @ORM\Column(name="week", type="integer", nullable=false)
     */
    private $week;

    /**
     * @var int
     *
     * @ORM\Column(name="teamid", type="integer", nullable=false)
     */
    private $teamid;

    /**
     * @var int
     *
     * @ORM\Column(name="playerid", type="integer", nullable=false)
     */
    private $playerid;

    /**
     * @var string
     *
     * @ORM\Column(name="side", type="string", length=0, nullable=false)
     */
    private $side;

    public function getGameplanId(): ?int
    {
        return $this->gameplanId;
    }

    public function getSeason(): ?\DateTimeInterface
    {
        return $this->season;
    }

    public function setSeason(\DateTimeInterface $season): self
    {
        $this->season = $season;

        return $this;
    }

    public function getWeek(): ?int
    {
        return $this->week;
    }

    public function setWeek(int $week): self
    {
        $this->week = $week;

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

    public function getPlayerid(): ?int
    {
        return $this->playerid;
    }

    public function setPlayerid(int $playerid): self
    {
        $this->playerid = $playerid;

        return $this;
    }

    public function getSide(): ?string
    {
        return $this->side;
    }

    public function setSide(string $side): self
    {
        $this->side = $side;

        return $this;
    }


}
