<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TmpScan
 *
 * @ORM\Table(name="tmp_scan")
 * @ORM\Entity
 */
class TmpScan
{
    /**
     * @var int
     *
     * @ORM\Column(name="scanId", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $scanid;

    /**
     * @var int|null
     *
     * @ORM\Column(name="season", type="integer", nullable=true, options={"default"="NULL"})
     */
    private $season = 'NULL';

    /**
     * @var int|null
     *
     * @ORM\Column(name="playerid", type="integer", nullable=true, options={"default"="NULL"})
     */
    private $playerid = 'NULL';

    /**
     * @var int|null
     *
     * @ORM\Column(name="group", type="integer", nullable=true, options={"default"="NULL"})
     */
    private $group = 'NULL';

    /**
     * @var string|null
     *
     * @ORM\Column(name="pos", type="string", length=3, nullable=true, options={"default"="NULL"})
     */
    private $pos = 'NULL';

    public function getScanid(): ?int
    {
        return $this->scanid;
    }

    public function getSeason(): ?int
    {
        return $this->season;
    }

    public function setSeason(?int $season): self
    {
        $this->season = $season;

        return $this;
    }

    public function getPlayerid(): ?int
    {
        return $this->playerid;
    }

    public function setPlayerid(?int $playerid): self
    {
        $this->playerid = $playerid;

        return $this;
    }

    public function getGroup(): ?int
    {
        return $this->group;
    }

    public function setGroup(?int $group): self
    {
        $this->group = $group;

        return $this;
    }

    public function getPos(): ?string
    {
        return $this->pos;
    }

    public function setPos(?string $pos): self
    {
        $this->pos = $pos;

        return $this;
    }


}
