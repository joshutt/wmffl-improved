<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Paid
 *
 * @ORM\Table(name="paid", uniqueConstraints={@ORM\UniqueConstraint(name="paid_teamid_season_uindex", columns={"teamid", "season"})})
 * @ORM\Entity
 */
class Paid
{
    /**
     * @var int
     *
     * @ORM\Column(name="teamid", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $teamid;

    /**
     * @var int
     *
     * @ORM\Column(name="season", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $season;

    /**
     * @var float|null
     *
     * @ORM\Column(name="previous", type="float", precision=10, scale=0, nullable=true)
     */
    private $previous = '0';

    /**
     * @var float|null
     *
     * @ORM\Column(name="entry_fee", type="float", precision=10, scale=0, nullable=true, options={"default"="75"})
     */
    private $entryFee = '75';

    /**
     * @var float|null
     *
     * @ORM\Column(name="late_fee", type="float", precision=10, scale=0, nullable=true)
     */
    private $lateFee = '0';

    /**
     * @var bool|null
     *
     * @ORM\Column(name="paid", type="boolean", nullable=true, options={"default"="1"})
     */
    private $paid = true;

    public function getTeamid(): ?int
    {
        return $this->teamid;
    }

    public function getSeason(): ?int
    {
        return $this->season;
    }

    public function getPrevious(): ?float
    {
        return $this->previous;
    }

    public function setPrevious(?float $previous): self
    {
        $this->previous = $previous;

        return $this;
    }

    public function getEntryFee(): ?float
    {
        return $this->entryFee;
    }

    public function setEntryFee(?float $entryFee): self
    {
        $this->entryFee = $entryFee;

        return $this;
    }

    public function getLateFee(): ?float
    {
        return $this->lateFee;
    }

    public function setLateFee(?float $lateFee): self
    {
        $this->lateFee = $lateFee;

        return $this;
    }

    public function getPaid(): ?bool
    {
        return $this->paid;
    }

    public function setPaid(?bool $paid): self
    {
        $this->paid = $paid;

        return $this;
    }


}
