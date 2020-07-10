<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Protectionallocation
 *
 * @ORM\Table(name="protectionallocation", uniqueConstraints={@ORM\UniqueConstraint(name="ProtectionID", columns={"ProtectionID"})})
 * @ORM\Entity
 */
class Protectionallocation
{
    /**
     * @var int
     *
     * @ORM\Column(name="ProtectionID", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $protectionid;

    /**
     * @var int
     *
     * @ORM\Column(name="TeamID", type="integer", nullable=false)
     */
    private $teamid = '0';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Season", type="date", nullable=false, options={"default"="0000"})
     */
    private $season = '0000';

    /**
     * @var bool|null
     *
     * @ORM\Column(name="Special", type="boolean", nullable=true, options={"default"="NULL"})
     */
    private $special = 'NULL';

    /**
     * @var bool
     *
     * @ORM\Column(name="HC", type="boolean", nullable=false)
     */
    private $hc = '0';

    /**
     * @var bool
     *
     * @ORM\Column(name="QB", type="boolean", nullable=false)
     */
    private $qb = '0';

    /**
     * @var bool
     *
     * @ORM\Column(name="RB", type="boolean", nullable=false)
     */
    private $rb = '0';

    /**
     * @var bool
     *
     * @ORM\Column(name="WR", type="boolean", nullable=false)
     */
    private $wr = '0';

    /**
     * @var bool
     *
     * @ORM\Column(name="TE", type="boolean", nullable=false)
     */
    private $te = '0';

    /**
     * @var bool
     *
     * @ORM\Column(name="K", type="boolean", nullable=false)
     */
    private $k = '0';

    /**
     * @var bool
     *
     * @ORM\Column(name="OL", type="boolean", nullable=false)
     */
    private $ol = '0';

    /**
     * @var bool
     *
     * @ORM\Column(name="DL", type="boolean", nullable=false)
     */
    private $dl = '0';

    /**
     * @var bool
     *
     * @ORM\Column(name="LB", type="boolean", nullable=false)
     */
    private $lb = '0';

    /**
     * @var bool
     *
     * @ORM\Column(name="DB", type="boolean", nullable=false)
     */
    private $db = '0';

    /**
     * @var bool
     *
     * @ORM\Column(name="General", type="boolean", nullable=false)
     */
    private $general = '0';

    public function getProtectionid(): ?int
    {
        return $this->protectionid;
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

    public function getSeason(): ?\DateTimeInterface
    {
        return $this->season;
    }

    public function setSeason(\DateTimeInterface $season): self
    {
        $this->season = $season;

        return $this;
    }

    public function getSpecial(): ?bool
    {
        return $this->special;
    }

    public function setSpecial(?bool $special): self
    {
        $this->special = $special;

        return $this;
    }

    public function getHc(): ?bool
    {
        return $this->hc;
    }

    public function setHc(bool $hc): self
    {
        $this->hc = $hc;

        return $this;
    }

    public function getQb(): ?bool
    {
        return $this->qb;
    }

    public function setQb(bool $qb): self
    {
        $this->qb = $qb;

        return $this;
    }

    public function getRb(): ?bool
    {
        return $this->rb;
    }

    public function setRb(bool $rb): self
    {
        $this->rb = $rb;

        return $this;
    }

    public function getWr(): ?bool
    {
        return $this->wr;
    }

    public function setWr(bool $wr): self
    {
        $this->wr = $wr;

        return $this;
    }

    public function getTe(): ?bool
    {
        return $this->te;
    }

    public function setTe(bool $te): self
    {
        $this->te = $te;

        return $this;
    }

    public function getK(): ?bool
    {
        return $this->k;
    }

    public function setK(bool $k): self
    {
        $this->k = $k;

        return $this;
    }

    public function getOl(): ?bool
    {
        return $this->ol;
    }

    public function setOl(bool $ol): self
    {
        $this->ol = $ol;

        return $this;
    }

    public function getDl(): ?bool
    {
        return $this->dl;
    }

    public function setDl(bool $dl): self
    {
        $this->dl = $dl;

        return $this;
    }

    public function getLb(): ?bool
    {
        return $this->lb;
    }

    public function setLb(bool $lb): self
    {
        $this->lb = $lb;

        return $this;
    }

    public function getDb(): ?bool
    {
        return $this->db;
    }

    public function setDb(bool $db): self
    {
        $this->db = $db;

        return $this;
    }

    public function getGeneral(): ?bool
    {
        return $this->general;
    }

    public function setGeneral(bool $general): self
    {
        $this->general = $general;

        return $this;
    }


}
