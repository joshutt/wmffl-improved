<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Offeredpoints
 *
 * @ORM\Table(name="offeredpoints")
 * @ORM\Entity
 */
class Offeredpoints
{
    /**
     * @var int
     *
     * @ORM\Column(name="OfferID", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $offerid = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="TeamFromID", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $teamfromid = '0';

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
     * @ORM\Column(name="Points", type="boolean", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $points = '0';

    public function getOfferid(): ?int
    {
        return $this->offerid;
    }

    public function getTeamfromid(): ?int
    {
        return $this->teamfromid;
    }

    public function getSeason(): ?\DateTimeInterface
    {
        return $this->season;
    }

    public function getPoints(): ?bool
    {
        return $this->points;
    }


}
