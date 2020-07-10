<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Draftpicks
 *
 * @ORM\Table(name="draftpicks", uniqueConstraints={@ORM\UniqueConstraint(name="Season", columns={"Season", "Round", "Pick"}), @ORM\UniqueConstraint(name="Season_2", columns={"Season", "playerid"})})
 * @ORM\Entity
 */
class Draftpicks
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
     * @ORM\Column(name="Season", type="date", nullable=false, options={"default"="0000"})
     */
    private $season = '0000';

    /**
     * @var bool
     *
     * @ORM\Column(name="Round", type="boolean", nullable=false)
     */
    private $round = '0';

    /**
     * @var bool|null
     *
     * @ORM\Column(name="Pick", type="boolean", nullable=true, options={"default"="NULL"})
     */
    private $pick = 'NULL';

    /**
     * @var int|null
     *
     * @ORM\Column(name="teamid", type="integer", nullable=true, options={"default"="NULL"})
     */
    private $teamid = 'NULL';

    /**
     * @var int|null
     *
     * @ORM\Column(name="orgTeam", type="integer", nullable=true, options={"default"="NULL"})
     */
    private $orgteam = 'NULL';

    /**
     * @var int|null
     *
     * @ORM\Column(name="playerid", type="integer", nullable=true, options={"default"="NULL"})
     */
    private $playerid = 'NULL';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="pickTime", type="datetime", nullable=false, options={"default"="current_timestamp()"})
     */
    private $picktime = 'current_timestamp()';

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

    public function getRound(): ?bool
    {
        return $this->round;
    }

    public function setRound(bool $round): self
    {
        $this->round = $round;

        return $this;
    }

    public function getPick(): ?bool
    {
        return $this->pick;
    }

    public function setPick(?bool $pick): self
    {
        $this->pick = $pick;

        return $this;
    }

    public function getTeamid(): ?int
    {
        return $this->teamid;
    }

    public function setTeamid(?int $teamid): self
    {
        $this->teamid = $teamid;

        return $this;
    }

    public function getOrgteam(): ?int
    {
        return $this->orgteam;
    }

    public function setOrgteam(?int $orgteam): self
    {
        $this->orgteam = $orgteam;

        return $this;
    }

    public function getPlayerid(): ?int
    {
        return $this->playerid;
    }

    public function setPlayerid(?int $playerid): self
    {
        $this->playerid = $playerid;

        return $this;
    }

    public function getPicktime(): ?\DateTimeInterface
    {
        return $this->picktime;
    }

    public function setPicktime(\DateTimeInterface $picktime): self
    {
        $this->picktime = $picktime;

        return $this;
    }


}
