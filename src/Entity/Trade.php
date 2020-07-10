<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Trade
 *
 * @ORM\Table(name="trade", uniqueConstraints={@ORM\UniqueConstraint(name="TradeID", columns={"TradeID"})})
 * @ORM\Entity
 */
class Trade
{
    /**
     * @var int
     *
     * @ORM\Column(name="TradeID", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $tradeid;

    /**
     * @var int
     *
     * @ORM\Column(name="TeamFromID", type="integer", nullable=false)
     */
    private $teamfromid = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="TeamToID", type="integer", nullable=false)
     */
    private $teamtoid = '0';

    /**
     * @var int|null
     *
     * @ORM\Column(name="PlayerID", type="integer", nullable=true, options={"default"="NULL"})
     */
    private $playerid = 'NULL';

    /**
     * @var string|null
     *
     * @ORM\Column(name="Other", type="text", length=65535, nullable=true, options={"default"="NULL"})
     */
    private $other = 'NULL';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Date", type="date", nullable=false, options={"default"="'0000-00-00'"})
     */
    private $date = '\'0000-00-00\'';

    /**
     * @var int
     *
     * @ORM\Column(name="TradeGroup", type="integer", nullable=false)
     */
    private $tradegroup = '0';

    public function getTradeid(): ?int
    {
        return $this->tradeid;
    }

    public function getTeamfromid(): ?int
    {
        return $this->teamfromid;
    }

    public function setTeamfromid(int $teamfromid): self
    {
        $this->teamfromid = $teamfromid;

        return $this;
    }

    public function getTeamtoid(): ?int
    {
        return $this->teamtoid;
    }

    public function setTeamtoid(int $teamtoid): self
    {
        $this->teamtoid = $teamtoid;

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

    public function getOther(): ?string
    {
        return $this->other;
    }

    public function setOther(?string $other): self
    {
        $this->other = $other;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getTradegroup(): ?int
    {
        return $this->tradegroup;
    }

    public function setTradegroup(int $tradegroup): self
    {
        $this->tradegroup = $tradegroup;

        return $this;
    }


}
