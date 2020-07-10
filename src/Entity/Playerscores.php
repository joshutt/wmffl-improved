<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Playerscores
 *
 * @ORM\Table(name="playerscores")
 * @ORM\Entity
 */
class Playerscores
{
    /**
     * @var int
     *
     * @ORM\Column(name="playerid", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $playerid = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="season", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $season = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="week", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $week = '0';

    /**
     * @var int|null
     *
     * @ORM\Column(name="pts", type="integer", nullable=true, options={"default"="NULL"})
     */
    private $pts = 'NULL';

    /**
     * @var int|null
     *
     * @ORM\Column(name="active", type="integer", nullable=true, options={"default"="NULL"})
     */
    private $active = 'NULL';

    public function getPlayerid(): ?int
    {
        return $this->playerid;
    }

    public function getSeason(): ?int
    {
        return $this->season;
    }

    public function getWeek(): ?int
    {
        return $this->week;
    }

    public function getPts(): ?int
    {
        return $this->pts;
    }

    public function setPts(?int $pts): self
    {
        $this->pts = $pts;

        return $this;
    }

    public function getActive(): ?int
    {
        return $this->active;
    }

    public function setActive(?int $active): self
    {
        $this->active = $active;

        return $this;
    }


}
