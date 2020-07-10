<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Owners
 *
 * @ORM\Table(name="owners")
 * @ORM\Entity
 */
class Owners
{
    /**
     * @var int
     *
     * @ORM\Column(name="teamid", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $teamid = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="userid", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $userid = '0';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="season", type="date", nullable=false, options={"default"="0000"})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $season = '0000';

    /**
     * @var bool
     *
     * @ORM\Column(name="primary", type="boolean", nullable=false, options={"default"="1"})
     */
    private $primary = true;

    public function getTeamid(): ?int
    {
        return $this->teamid;
    }

    public function getUserid(): ?int
    {
        return $this->userid;
    }

    public function getSeason(): ?\DateTimeInterface
    {
        return $this->season;
    }

    public function getPrimary(): ?bool
    {
        return $this->primary;
    }

    public function setPrimary(bool $primary): self
    {
        $this->primary = $primary;

        return $this;
    }


}
