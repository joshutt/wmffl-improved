<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Nflrosters
 *
 * @ORM\Table(name="nflrosters", indexes={@ORM\Index(name="playerdate", columns={"playerid", "dateon"})})
 * @ORM\Entity
 */
class Nflrosters
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
     * @var string
     *
     * @ORM\Column(name="nflteamid", type="string", length=3, nullable=false, options={"default"="'0'","fixed"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $nflteamid = '\'0\'';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateon", type="date", nullable=false, options={"default"="'0000-00-00'"})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $dateon = '\'0000-00-00\'';

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="dateoff", type="date", nullable=true, options={"default"="NULL"})
     */
    private $dateoff = 'NULL';

    /**
     * @var string
     *
     * @ORM\Column(name="pos", type="string", length=3, nullable=false, options={"default"="''","fixed"=true})
     */
    private $pos = '\'\'';

    public function getPlayerid(): ?int
    {
        return $this->playerid;
    }

    public function getNflteamid(): ?string
    {
        return $this->nflteamid;
    }

    public function getDateon(): ?\DateTimeInterface
    {
        return $this->dateon;
    }

    public function getDateoff(): ?\DateTimeInterface
    {
        return $this->dateoff;
    }

    public function setDateoff(?\DateTimeInterface $dateoff): self
    {
        $this->dateoff = $dateoff;

        return $this;
    }

    public function getPos(): ?string
    {
        return $this->pos;
    }

    public function setPos(string $pos): self
    {
        $this->pos = $pos;

        return $this;
    }


}
