<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Protectioncost
 *
 * @ORM\Table(name="protectioncost")
 * @ORM\Entity
 */
class Protectioncost
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
     * @ORM\Column(name="years", type="integer", nullable=true)
     */
    private $years = '0';

    public function getPlayerid(): ?int
    {
        return $this->playerid;
    }

    public function getSeason(): ?\DateTimeInterface
    {
        return $this->season;
    }

    public function getYears(): ?int
    {
        return $this->years;
    }

    public function setYears(?int $years): self
    {
        $this->years = $years;

        return $this;
    }


}
