<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Revisedactivations
 *
 * @ORM\Table(name="revisedactivations", indexes={@ORM\Index(name="season", columns={"season", "week", "teamid"})})
 * @ORM\Entity
 */
class Revisedactivations
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
     * @ORM\Column(name="season", type="date", nullable=false, options={"default"="0000"})
     */
    private $season = '0000';

    /**
     * @var int
     *
     * @ORM\Column(name="week", type="integer", nullable=false)
     */
    private $week = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="teamid", type="integer", nullable=false)
     */
    private $teamid = '0';

    /**
     * @var string|null
     *
     * @ORM\Column(name="pos", type="string", length=0, nullable=true, options={"default"="NULL"})
     */
    private $pos = 'NULL';

    /**
     * @var int
     *
     * @ORM\Column(name="playerid", type="integer", nullable=false)
     */
    private $playerid = '0';

    public function getId(): ?int
    {
        return $this->id;
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

    public function getPos(): ?string
    {
        return $this->pos;
    }

    public function setPos(?string $pos): self
    {
        $this->pos = $pos;

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
