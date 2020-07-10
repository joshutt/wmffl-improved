<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Offer
 *
 * @ORM\Table(name="offer")
 * @ORM\Entity
 */
class Offer
{
    /**
     * @var int
     *
     * @ORM\Column(name="OfferID", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $offerid;

    /**
     * @var int
     *
     * @ORM\Column(name="TeamAID", type="integer", nullable=false)
     */
    private $teamaid = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="TeamBID", type="integer", nullable=false)
     */
    private $teambid = '0';

    /**
     * @var string|null
     *
     * @ORM\Column(name="Status", type="string", length=0, nullable=true, options={"default"="'Pending'"})
     */
    private $status = '\'Pending\'';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Date", type="datetime", nullable=false, options={"default"="'0000-00-00 00:00:00'"})
     */
    private $date = '\'0000-00-00 00:00:00\'';

    /**
     * @var int
     *
     * @ORM\Column(name="LastOfferID", type="integer", nullable=false)
     */
    private $lastofferid = '0';

    public function getOfferid(): ?int
    {
        return $this->offerid;
    }

    public function getTeamaid(): ?int
    {
        return $this->teamaid;
    }

    public function setTeamaid(int $teamaid): self
    {
        $this->teamaid = $teamaid;

        return $this;
    }

    public function getTeambid(): ?int
    {
        return $this->teambid;
    }

    public function setTeambid(int $teambid): self
    {
        $this->teambid = $teambid;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status): self
    {
        $this->status = $status;

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

    public function getLastofferid(): ?int
    {
        return $this->lastofferid;
    }

    public function setLastofferid(int $lastofferid): self
    {
        $this->lastofferid = $lastofferid;

        return $this;
    }


}
