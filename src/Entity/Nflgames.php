<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Nflgames
 *
 * @ORM\Table(name="nflgames")
 * @ORM\Entity
 */
class Nflgames
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
     * @var string
     *
     * @ORM\Column(name="homeTeam", type="string", length=3, nullable=false, options={"default"="''","fixed"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $hometeam = '\'\'';

    /**
     * @var string
     *
     * @ORM\Column(name="roadTeam", type="string", length=3, nullable=false, options={"default"="''","fixed"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $roadteam = '\'\'';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="kickoff", type="datetime", nullable=false, options={"default"="'0000-00-00 00:00:00'"})
     */
    private $kickoff = '\'0000-00-00 00:00:00\'';

    /**
     * @var int
     *
     * @ORM\Column(name="secRemain", type="integer", nullable=false)
     */
    private $secremain = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="complete", type="integer", nullable=false)
     */
    private $complete = '0';

    /**
     * @var int|null
     *
     * @ORM\Column(name="homeScore", type="integer", nullable=true, options={"default"="NULL"})
     */
    private $homescore = 'NULL';

    /**
     * @var int|null
     *
     * @ORM\Column(name="roadScore", type="integer", nullable=true, options={"default"="NULL"})
     */
    private $roadscore = 'NULL';

    public function getSeason(): ?\DateTimeInterface
    {
        return $this->season;
    }

    public function getWeek(): ?int
    {
        return $this->week;
    }

    public function getHometeam(): ?string
    {
        return $this->hometeam;
    }

    public function getRoadteam(): ?string
    {
        return $this->roadteam;
    }

    public function getKickoff(): ?\DateTimeInterface
    {
        return $this->kickoff;
    }

    public function setKickoff(\DateTimeInterface $kickoff): self
    {
        $this->kickoff = $kickoff;

        return $this;
    }

    public function getSecremain(): ?int
    {
        return $this->secremain;
    }

    public function setSecremain(int $secremain): self
    {
        $this->secremain = $secremain;

        return $this;
    }

    public function getComplete(): ?int
    {
        return $this->complete;
    }

    public function setComplete(int $complete): self
    {
        $this->complete = $complete;

        return $this;
    }

    public function getHomescore(): ?int
    {
        return $this->homescore;
    }

    public function setHomescore(?int $homescore): self
    {
        $this->homescore = $homescore;

        return $this;
    }

    public function getRoadscore(): ?int
    {
        return $this->roadscore;
    }

    public function setRoadscore(?int $roadscore): self
    {
        $this->roadscore = $roadscore;

        return $this;
    }


}
