<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Draftvote
 *
 * @ORM\Table(name="draftvote")
 * @ORM\Entity
 */
class Draftvote
{
    /**
     * @var int
     *
     * @ORM\Column(name="userid", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $userid;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="season", type="date", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $season;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="lastUpdate", type="datetime", nullable=true, options={"default"="NULL"})
     */
    private $lastupdate = 'NULL';

    public function getUserid(): ?int
    {
        return $this->userid;
    }

    public function getSeason(): ?\DateTimeInterface
    {
        return $this->season;
    }

    public function getLastupdate(): ?\DateTimeInterface
    {
        return $this->lastupdate;
    }

    public function setLastupdate(?\DateTimeInterface $lastupdate): self
    {
        $this->lastupdate = $lastupdate;

        return $this;
    }


}
