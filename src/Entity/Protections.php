<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Protections
 *
 * @ORM\Table(name="protections")
 * @ORM\Entity
 */
class Protections
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
     * @var int
     *
     * @ORM\Column(name="playerid", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $playerid = '0';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="season", type="date", nullable=false, options={"default"="0000"})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $season = '0000';

    /**
     * @var int|null
     *
     * @ORM\Column(name="cost", type="integer", nullable=true, options={"default"="NULL"})
     */
    private $cost = 'NULL';

    public function getTeamid(): ?int
    {
        return $this->teamid;
    }

    public function getPlayerid(): ?int
    {
        return $this->playerid;
    }

    public function getSeason(): ?\DateTimeInterface
    {
        return $this->season;
    }

    public function getCost(): ?int
    {
        return $this->cost;
    }

    public function setCost(?int $cost): self
    {
        $this->cost = $cost;

        return $this;
    }


}
