<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Offeredplayers
 *
 * @ORM\Table(name="offeredplayers")
 * @ORM\Entity
 */
class Offeredplayers
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
     * @var int
     *
     * @ORM\Column(name="PlayerID", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $playerid = '0';

    public function getOfferid(): ?int
    {
        return $this->offerid;
    }

    public function getTeamfromid(): ?int
    {
        return $this->teamfromid;
    }

    public function getPlayerid(): ?int
    {
        return $this->playerid;
    }


}
