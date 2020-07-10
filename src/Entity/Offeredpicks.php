<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Offeredpicks
 *
 * @ORM\Table(name="offeredpicks")
 * @ORM\Entity
 */
class Offeredpicks
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
     * @ORM\Column(name="Round", type="boolean", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $round = '0';

    /**
     * @var int|null
     *
     * @ORM\Column(name="OrgTeam", type="integer", nullable=true, options={"default"="NULL"})
     */
    private $orgteam = 'NULL';

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

    public function getRound(): ?bool
    {
        return $this->round;
    }

    public function getOrgteam(): ?int
    {
        return $this->orgteam;
    }

    public function setOrgteam(?int $orgteam): self
    {
        $this->orgteam = $orgteam;

        return $this;
    }


}
