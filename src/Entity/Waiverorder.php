<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Waiverorder
 *
 * @ORM\Table(name="waiverorder")
 * @ORM\Entity
 */
class Waiverorder
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="season", type="date", nullable=false, options={"default"="0000"})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $season = '0000';

    /**
     * @var int
     *
     * @ORM\Column(name="week", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $week = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="ordernumber", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $ordernumber = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="teamid", type="integer", nullable=false)
     */
    private $teamid = '0';

    public function getSeason(): ?\DateTimeInterface
    {
        return $this->season;
    }

    public function getWeek(): ?int
    {
        return $this->week;
    }

    public function getOrdernumber(): ?int
    {
        return $this->ordernumber;
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


}
