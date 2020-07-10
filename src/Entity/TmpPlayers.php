<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TmpPlayers
 *
 * @ORM\Table(name="tmp_players")
 * @ORM\Entity
 */
class TmpPlayers
{
    /**
     * @var int
     *
     * @ORM\Column(name="playerid", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $playerid;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="season", type="date", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $season;

    /**
     * @var int
     *
     * @ORM\Column(name="pts", type="integer", nullable=false)
     */
    private $pts;

    public function getPlayerid(): ?int
    {
        return $this->playerid;
    }

    public function getSeason(): ?\DateTimeInterface
    {
        return $this->season;
    }

    public function getPts(): ?int
    {
        return $this->pts;
    }

    public function setPts(int $pts): self
    {
        $this->pts = $pts;

        return $this;
    }


}
