<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Nflstatus
 *
 * @ORM\Table(name="nflstatus")
 * @ORM\Entity
 */
class Nflstatus
{
    /**
     * @var string
     *
     * @ORM\Column(name="nflteam", type="string", length=3, nullable=false, options={"default"="''","fixed"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $nflteam = '\'\'';

    /**
     * @var int
     *
     * @ORM\Column(name="season", type="integer", nullable=false, options={"default"="2002"})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $season = '2002';

    /**
     * @var int
     *
     * @ORM\Column(name="week", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $week = '0';

    /**
     * @var string|null
     *
     * @ORM\Column(name="status", type="string", length=0, nullable=true, options={"default"="NULL"})
     */
    private $status = 'NULL';

    public function getNflteam(): ?string
    {
        return $this->nflteam;
    }

    public function getSeason(): ?int
    {
        return $this->season;
    }

    public function getWeek(): ?int
    {
        return $this->week;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status): self
    {
        $this->status = $status;

        return $this;
    }


}
