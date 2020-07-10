<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Nflbyes
 *
 * @ORM\Table(name="nflbyes")
 * @ORM\Entity
 */
class Nflbyes
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="season", type="date", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $season;

    /**
     * @var bool
     *
     * @ORM\Column(name="week", type="boolean", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $week;

    /**
     * @var string
     *
     * @ORM\Column(name="nflteam", type="string", length=3, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $nflteam;

    public function getSeason(): ?\DateTimeInterface
    {
        return $this->season;
    }

    public function getWeek(): ?bool
    {
        return $this->week;
    }

    public function getNflteam(): ?string
    {
        return $this->nflteam;
    }


}
