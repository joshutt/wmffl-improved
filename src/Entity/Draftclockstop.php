<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Draftclockstop
 *
 * @ORM\Table(name="draftclockstop", indexes={@ORM\Index(name="season", columns={"season"})})
 * @ORM\Entity
 */
class Draftclockstop
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="season", type="date", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $season;

    /**
     * @var int
     *
     * @ORM\Column(name="round", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $round;

    /**
     * @var int
     *
     * @ORM\Column(name="pick", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $pick;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="timeStopped", type="datetime", nullable=true, options={"default"="NULL"})
     */
    private $timestopped = 'NULL';

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="timeStarted", type="datetime", nullable=true, options={"default"="NULL"})
     */
    private $timestarted = 'NULL';

    public function getSeason(): ?\DateTimeInterface
    {
        return $this->season;
    }

    public function getRound(): ?int
    {
        return $this->round;
    }

    public function getPick(): ?int
    {
        return $this->pick;
    }

    public function getTimestopped(): ?\DateTimeInterface
    {
        return $this->timestopped;
    }

    public function setTimestopped(?\DateTimeInterface $timestopped): self
    {
        $this->timestopped = $timestopped;

        return $this;
    }

    public function getTimestarted(): ?\DateTimeInterface
    {
        return $this->timestarted;
    }

    public function setTimestarted(?\DateTimeInterface $timestarted): self
    {
        $this->timestarted = $timestarted;

        return $this;
    }


}
