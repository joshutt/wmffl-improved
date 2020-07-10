<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Activations
 *
 * @ORM\Table(name="activations", uniqueConstraints={@ORM\UniqueConstraint(name="TeamID", columns={"TeamID", "Season", "Week"})})
 * @ORM\Entity
 */
class Activations
{
    /**
     * @var int
     *
     * @ORM\Column(name="TeamID", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $teamid = '0';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Season", type="date", nullable=false, options={"default"="0000"})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $season = '0000';

    /**
     * @var bool
     *
     * @ORM\Column(name="Week", type="boolean", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $week = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="HC", type="integer", nullable=false)
     */
    private $hc = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="QB", type="integer", nullable=false)
     */
    private $qb = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="RB1", type="integer", nullable=false)
     */
    private $rb1 = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="RB2", type="integer", nullable=false)
     */
    private $rb2 = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="WR1", type="integer", nullable=false)
     */
    private $wr1 = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="WR2", type="integer", nullable=false)
     */
    private $wr2 = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="TE", type="integer", nullable=false)
     */
    private $te = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="K", type="integer", nullable=false)
     */
    private $k = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="OL", type="integer", nullable=false)
     */
    private $ol = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="DL1", type="integer", nullable=false)
     */
    private $dl1 = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="DL2", type="integer", nullable=false)
     */
    private $dl2 = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="LB1", type="integer", nullable=false)
     */
    private $lb1 = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="LB2", type="integer", nullable=false)
     */
    private $lb2 = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="DB1", type="integer", nullable=false)
     */
    private $db1 = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="DB2", type="integer", nullable=false)
     */
    private $db2 = '0';

    public function getTeamid(): ?int
    {
        return $this->teamid;
    }

    public function getSeason(): ?\DateTimeInterface
    {
        return $this->season;
    }

    public function getWeek(): ?bool
    {
        return $this->week;
    }

    public function getHc(): ?int
    {
        return $this->hc;
    }

    public function setHc(int $hc): self
    {
        $this->hc = $hc;

        return $this;
    }

    public function getQb(): ?int
    {
        return $this->qb;
    }

    public function setQb(int $qb): self
    {
        $this->qb = $qb;

        return $this;
    }

    public function getRb1(): ?int
    {
        return $this->rb1;
    }

    public function setRb1(int $rb1): self
    {
        $this->rb1 = $rb1;

        return $this;
    }

    public function getRb2(): ?int
    {
        return $this->rb2;
    }

    public function setRb2(int $rb2): self
    {
        $this->rb2 = $rb2;

        return $this;
    }

    public function getWr1(): ?int
    {
        return $this->wr1;
    }

    public function setWr1(int $wr1): self
    {
        $this->wr1 = $wr1;

        return $this;
    }

    public function getWr2(): ?int
    {
        return $this->wr2;
    }

    public function setWr2(int $wr2): self
    {
        $this->wr2 = $wr2;

        return $this;
    }

    public function getTe(): ?int
    {
        return $this->te;
    }

    public function setTe(int $te): self
    {
        $this->te = $te;

        return $this;
    }

    public function getK(): ?int
    {
        return $this->k;
    }

    public function setK(int $k): self
    {
        $this->k = $k;

        return $this;
    }

    public function getOl(): ?int
    {
        return $this->ol;
    }

    public function setOl(int $ol): self
    {
        $this->ol = $ol;

        return $this;
    }

    public function getDl1(): ?int
    {
        return $this->dl1;
    }

    public function setDl1(int $dl1): self
    {
        $this->dl1 = $dl1;

        return $this;
    }

    public function getDl2(): ?int
    {
        return $this->dl2;
    }

    public function setDl2(int $dl2): self
    {
        $this->dl2 = $dl2;

        return $this;
    }

    public function getLb1(): ?int
    {
        return $this->lb1;
    }

    public function setLb1(int $lb1): self
    {
        $this->lb1 = $lb1;

        return $this;
    }

    public function getLb2(): ?int
    {
        return $this->lb2;
    }

    public function setLb2(int $lb2): self
    {
        $this->lb2 = $lb2;

        return $this;
    }

    public function getDb1(): ?int
    {
        return $this->db1;
    }

    public function setDb1(int $db1): self
    {
        $this->db1 = $db1;

        return $this;
    }

    public function getDb2(): ?int
    {
        return $this->db2;
    }

    public function setDb2(int $db2): self
    {
        $this->db2 = $db2;

        return $this;
    }


}
