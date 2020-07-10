<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Stats
 *
 * @ORM\Table(name="stats", indexes={@ORM\Index(name="Season", columns={"Season", "week"})})
 * @ORM\Entity
 */
class Stats
{
    /**
     * @var int
     *
     * @ORM\Column(name="statid", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $statid = '0';

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
     * @ORM\Column(name="Season", type="integer", nullable=false, options={"default"="2002"})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $season = '2002';

    /**
     * @var bool
     *
     * @ORM\Column(name="played", type="boolean", nullable=false, options={"default"="1"})
     */
    private $played = true;

    /**
     * @var int|null
     *
     * @ORM\Column(name="yards", type="integer", nullable=true)
     */
    private $yards = '0';

    /**
     * @var int|null
     *
     * @ORM\Column(name="intthrow", type="integer", nullable=true)
     */
    private $intthrow = '0';

    /**
     * @var int|null
     *
     * @ORM\Column(name="rec", type="integer", nullable=true)
     */
    private $rec = '0';

    /**
     * @var int|null
     *
     * @ORM\Column(name="fum", type="integer", nullable=true)
     */
    private $fum = '0';

    /**
     * @var int|null
     *
     * @ORM\Column(name="tackles", type="integer", nullable=true)
     */
    private $tackles = '0';

    /**
     * @var float|null
     *
     * @ORM\Column(name="sacks", type="float", precision=10, scale=0, nullable=true)
     */
    private $sacks = '0';

    /**
     * @var int|null
     *
     * @ORM\Column(name="intcatch", type="integer", nullable=true)
     */
    private $intcatch = '0';

    /**
     * @var int|null
     *
     * @ORM\Column(name="passdefend", type="integer", nullable=true)
     */
    private $passdefend = '0';

    /**
     * @var int|null
     *
     * @ORM\Column(name="returnyards", type="integer", nullable=true)
     */
    private $returnyards = '0';

    /**
     * @var int|null
     *
     * @ORM\Column(name="fumrec", type="integer", nullable=true)
     */
    private $fumrec = '0';

    /**
     * @var int|null
     *
     * @ORM\Column(name="forcefum", type="integer", nullable=true)
     */
    private $forcefum = '0';

    /**
     * @var int|null
     *
     * @ORM\Column(name="tds", type="integer", nullable=true)
     */
    private $tds = '0';

    /**
     * @var int|null
     *
     * @ORM\Column(name="2pt", type="integer", nullable=true)
     */
    private $twopt = '0';

    /**
     * @var int|null
     *
     * @ORM\Column(name="specTD", type="integer", nullable=true)
     */
    private $spectd = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="Safety", type="integer", nullable=false)
     */
    private $safety = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="XP", type="integer", nullable=false)
     */
    private $xp = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="MissXP", type="integer", nullable=false)
     */
    private $missxp = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="FG30", type="integer", nullable=false)
     */
    private $fg30 = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="FG40", type="integer", nullable=false)
     */
    private $fg40 = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="FG50", type="integer", nullable=false)
     */
    private $fg50 = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="FG60", type="integer", nullable=false)
     */
    private $fg60 = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="MissFG30", type="integer", nullable=false)
     */
    private $missfg30 = '0';

    /**
     * @var int|null
     *
     * @ORM\Column(name="ptdiff", type="integer", nullable=true, options={"default"="NULL"})
     */
    private $ptdiff = 'NULL';

    /**
     * @var int
     *
     * @ORM\Column(name="blockpunt", type="integer", nullable=false)
     */
    private $blockpunt = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="blockfg", type="integer", nullable=false)
     */
    private $blockfg = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="blockxp", type="integer", nullable=false)
     */
    private $blockxp = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="penalties", type="integer", nullable=false)
     */
    private $penalties = '0';

    public function getStatid(): ?int
    {
        return $this->statid;
    }

    public function getWeek(): ?int
    {
        return $this->week;
    }

    public function getSeason(): ?int
    {
        return $this->season;
    }

    public function getPlayed(): ?bool
    {
        return $this->played;
    }

    public function setPlayed(bool $played): self
    {
        $this->played = $played;

        return $this;
    }

    public function getYards(): ?int
    {
        return $this->yards;
    }

    public function setYards(?int $yards): self
    {
        $this->yards = $yards;

        return $this;
    }

    public function getIntthrow(): ?int
    {
        return $this->intthrow;
    }

    public function setIntthrow(?int $intthrow): self
    {
        $this->intthrow = $intthrow;

        return $this;
    }

    public function getRec(): ?int
    {
        return $this->rec;
    }

    public function setRec(?int $rec): self
    {
        $this->rec = $rec;

        return $this;
    }

    public function getFum(): ?int
    {
        return $this->fum;
    }

    public function setFum(?int $fum): self
    {
        $this->fum = $fum;

        return $this;
    }

    public function getTackles(): ?int
    {
        return $this->tackles;
    }

    public function setTackles(?int $tackles): self
    {
        $this->tackles = $tackles;

        return $this;
    }

    public function getSacks(): ?float
    {
        return $this->sacks;
    }

    public function setSacks(?float $sacks): self
    {
        $this->sacks = $sacks;

        return $this;
    }

    public function getIntcatch(): ?int
    {
        return $this->intcatch;
    }

    public function setIntcatch(?int $intcatch): self
    {
        $this->intcatch = $intcatch;

        return $this;
    }

    public function getPassdefend(): ?int
    {
        return $this->passdefend;
    }

    public function setPassdefend(?int $passdefend): self
    {
        $this->passdefend = $passdefend;

        return $this;
    }

    public function getReturnyards(): ?int
    {
        return $this->returnyards;
    }

    public function setReturnyards(?int $returnyards): self
    {
        $this->returnyards = $returnyards;

        return $this;
    }

    public function getFumrec(): ?int
    {
        return $this->fumrec;
    }

    public function setFumrec(?int $fumrec): self
    {
        $this->fumrec = $fumrec;

        return $this;
    }

    public function getForcefum(): ?int
    {
        return $this->forcefum;
    }

    public function setForcefum(?int $forcefum): self
    {
        $this->forcefum = $forcefum;

        return $this;
    }

    public function getTds(): ?int
    {
        return $this->tds;
    }

    public function setTds(?int $tds): self
    {
        $this->tds = $tds;

        return $this;
    }

    public function getTwopt(): ?int
    {
        return $this->twopt;
    }

    public function setTwopt(?int $twopt): self
    {
        $this->twopt = $twopt;

        return $this;
    }

    public function getSpectd(): ?int
    {
        return $this->spectd;
    }

    public function setSpectd(?int $spectd): self
    {
        $this->spectd = $spectd;

        return $this;
    }

    public function getSafety(): ?int
    {
        return $this->safety;
    }

    public function setSafety(int $safety): self
    {
        $this->safety = $safety;

        return $this;
    }

    public function getXp(): ?int
    {
        return $this->xp;
    }

    public function setXp(int $xp): self
    {
        $this->xp = $xp;

        return $this;
    }

    public function getMissxp(): ?int
    {
        return $this->missxp;
    }

    public function setMissxp(int $missxp): self
    {
        $this->missxp = $missxp;

        return $this;
    }

    public function getFg30(): ?int
    {
        return $this->fg30;
    }

    public function setFg30(int $fg30): self
    {
        $this->fg30 = $fg30;

        return $this;
    }

    public function getFg40(): ?int
    {
        return $this->fg40;
    }

    public function setFg40(int $fg40): self
    {
        $this->fg40 = $fg40;

        return $this;
    }

    public function getFg50(): ?int
    {
        return $this->fg50;
    }

    public function setFg50(int $fg50): self
    {
        $this->fg50 = $fg50;

        return $this;
    }

    public function getFg60(): ?int
    {
        return $this->fg60;
    }

    public function setFg60(int $fg60): self
    {
        $this->fg60 = $fg60;

        return $this;
    }

    public function getMissfg30(): ?int
    {
        return $this->missfg30;
    }

    public function setMissfg30(int $missfg30): self
    {
        $this->missfg30 = $missfg30;

        return $this;
    }

    public function getPtdiff(): ?int
    {
        return $this->ptdiff;
    }

    public function setPtdiff(?int $ptdiff): self
    {
        $this->ptdiff = $ptdiff;

        return $this;
    }

    public function getBlockpunt(): ?int
    {
        return $this->blockpunt;
    }

    public function setBlockpunt(int $blockpunt): self
    {
        $this->blockpunt = $blockpunt;

        return $this;
    }

    public function getBlockfg(): ?int
    {
        return $this->blockfg;
    }

    public function setBlockfg(int $blockfg): self
    {
        $this->blockfg = $blockfg;

        return $this;
    }

    public function getBlockxp(): ?int
    {
        return $this->blockxp;
    }

    public function setBlockxp(int $blockxp): self
    {
        $this->blockxp = $blockxp;

        return $this;
    }

    public function getPenalties(): ?int
    {
        return $this->penalties;
    }

    public function setPenalties(int $penalties): self
    {
        $this->penalties = $penalties;

        return $this;
    }


}
