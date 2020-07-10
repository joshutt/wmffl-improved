<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Transactions
 *
 * @ORM\Table(name="transactions")
 * @ORM\Entity
 */
class Transactions
{
    /**
     * @var int
     *
     * @ORM\Column(name="TransactionID", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $transactionid;

    /**
     * @var int
     *
     * @ORM\Column(name="TeamID", type="integer", nullable=false)
     */
    private $teamid = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="PlayerID", type="integer", nullable=false)
     */
    private $playerid = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="Method", type="string", length=0, nullable=false, options={"default"="'Cut'"})
     */
    private $method = '\'Cut\'';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Date", type="datetime", nullable=false, options={"default"="'0000-00-00 00:00:00'"})
     */
    private $date = '\'0000-00-00 00:00:00\'';

    public function getTransactionid(): ?int
    {
        return $this->transactionid;
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

    public function getPlayerid(): ?int
    {
        return $this->playerid;
    }

    public function setPlayerid(int $playerid): self
    {
        $this->playerid = $playerid;

        return $this;
    }

    public function getMethod(): ?string
    {
        return $this->method;
    }

    public function setMethod(string $method): self
    {
        $this->method = $method;

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


}
