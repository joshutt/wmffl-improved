<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Playerteams
 *
 * @ORM\Table(name="playerteams", indexes={@ORM\Index(name="playerid", columns={"playerid", "nflteam"})})
 * @ORM\Entity
 */
class Playerteams
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="playerid", type="integer", nullable=false)
     */
    private $playerid = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="nflteam", type="string", length=3, nullable=false, options={"default"="''","fixed"=true})
     */
    private $nflteam = '\'\'';

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="startdate", type="date", nullable=true, options={"default"="NULL"})
     */
    private $startdate = 'NULL';

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="enddate", type="date", nullable=true, options={"default"="NULL"})
     */
    private $enddate = 'NULL';

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPlayerid(): ?int
    {
        return $this->playerid;
    }

    public function setPlayerid(int $playerid): self
    {
        $this->playerid = $playerid;

        return $this;
    }

    public function getNflteam(): ?string
    {
        return $this->nflteam;
    }

    public function setNflteam(string $nflteam): self
    {
        $this->nflteam = $nflteam;

        return $this;
    }

    public function getStartdate(): ?\DateTimeInterface
    {
        return $this->startdate;
    }

    public function setStartdate(?\DateTimeInterface $startdate): self
    {
        $this->startdate = $startdate;

        return $this;
    }

    public function getEnddate(): ?\DateTimeInterface
    {
        return $this->enddate;
    }

    public function setEnddate(?\DateTimeInterface $enddate): self
    {
        $this->enddate = $enddate;

        return $this;
    }


}
