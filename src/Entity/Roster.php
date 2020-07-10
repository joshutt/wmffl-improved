<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Roster
 *
 * @ORM\Table(name="roster", indexes={@ORM\Index(name="team_key", columns={"TeamID"}), @ORM\Index(name="dateOn_key", columns={"DateOn"}), @ORM\Index(name="player_key", columns={"PlayerID", "TeamID"})})
 * @ORM\Entity
 */
class Roster
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
     * @ORM\Column(name="PlayerID", type="integer", nullable=false)
     */
    private $playerid = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="TeamID", type="integer", nullable=false)
     */
    private $teamid = '0';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DateOn", type="datetime", nullable=false, options={"default"="'0000-00-00 00:00:00'"})
     */
    private $dateon = '\'0000-00-00 00:00:00\'';

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="DateOff", type="datetime", nullable=true, options={"default"="NULL"})
     */
    private $dateoff = 'NULL';

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

    public function getDateon(): ?\DateTimeInterface
    {
        return $this->dateon;
    }

    public function setDateon(\DateTimeInterface $dateon): self
    {
        $this->dateon = $dateon;

        return $this;
    }

    public function getDateoff(): ?\DateTimeInterface
    {
        return $this->dateoff;
    }

    public function setDateoff(?\DateTimeInterface $dateoff): self
    {
        $this->dateoff = $dateoff;

        return $this;
    }


}
