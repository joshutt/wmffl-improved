<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Titles
 *
 * @ORM\Table(name="titles")
 * @ORM\Entity
 */
class Titles
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="season", type="date", nullable=false, options={"default"="0000"})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $season = '0000';

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=0, nullable=false, options={"default"="'League'"})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $type = '\'League\'';

    /**
     * @var int
     *
     * @ORM\Column(name="teamid", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $teamid = '0';

    public function getSeason(): ?\DateTimeInterface
    {
        return $this->season;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function getTeamid(): ?int
    {
        return $this->teamid;
    }


}
