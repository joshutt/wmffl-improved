<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Teamnames
 *
 * @ORM\Table(name="teamnames")
 * @ORM\Entity
 */
class Teamnames
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
     * @var \DateTime
     *
     * @ORM\Column(name="season", type="date", nullable=false, options={"default"="0000"})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $season = '0000';

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=50, nullable=false, options={"default"="''"})
     */
    private $name = '\'\'';

    /**
     * @var string
     *
     * @ORM\Column(name="abbrev", type="string", length=3, nullable=false, options={"default"="''","fixed"=true})
     */
    private $abbrev = '\'\'';

    /**
     * @var int
     *
     * @ORM\Column(name="divisionId", type="integer", nullable=false)
     */
    private $divisionid = '0';

    public function getTeamid(): ?int
    {
        return $this->teamid;
    }

    public function getSeason(): ?\DateTimeInterface
    {
        return $this->season;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getAbbrev(): ?string
    {
        return $this->abbrev;
    }

    public function setAbbrev(string $abbrev): self
    {
        $this->abbrev = $abbrev;

        return $this;
    }

    public function getDivisionid(): ?int
    {
        return $this->divisionid;
    }

    public function setDivisionid(int $divisionid): self
    {
        $this->divisionid = $divisionid;

        return $this;
    }


}
