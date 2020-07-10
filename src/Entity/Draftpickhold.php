<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Draftpickhold
 *
 * @ORM\Table(name="draftpickhold")
 * @ORM\Entity
 */
class Draftpickhold
{
    /**
     * @var int
     *
     * @ORM\Column(name="teamid", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $teamid;

    /**
     * @var int|null
     *
     * @ORM\Column(name="playerid", type="integer", nullable=true, options={"default"="NULL"})
     */
    private $playerid = 'NULL';

    public function getTeamid(): ?int
    {
        return $this->teamid;
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


}
