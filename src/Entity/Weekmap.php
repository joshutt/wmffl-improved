<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Weekmap
 *
 * @ORM\Table(name="weekmap")
 * @ORM\Entity
 */
class Weekmap
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Season", type="date", nullable=false, options={"default"="0000"})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $season = '0000';

    /**
     * @var int
     *
     * @ORM\Column(name="Week", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $week = '0';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="StartDate", type="datetime", nullable=false, options={"default"="'0000-00-00 00:00:00'"})
     */
    private $startdate = '\'0000-00-00 00:00:00\'';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="EndDate", type="datetime", nullable=false, options={"default"="'0000-00-00 00:00:00'"})
     */
    private $enddate = '\'0000-00-00 00:00:00\'';

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="ActivationDue", type="datetime", nullable=true, options={"default"="NULL"})
     */
    private $activationdue = 'NULL';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DisplayDate", type="datetime", nullable=false, options={"default"="'0000-00-00 00:00:00'"})
     */
    private $displaydate = '\'0000-00-00 00:00:00\'';

    /**
     * @var string|null
     *
     * @ORM\Column(name="weekname", type="string", length=22, nullable=true, options={"default"="NULL"})
     */
    private $weekname = 'NULL';

    public function getSeason(): ?\DateTimeInterface
    {
        return $this->season;
    }

    public function getWeek(): ?int
    {
        return $this->week;
    }

    public function getStartdate(): ?\DateTimeInterface
    {
        return $this->startdate;
    }

    public function setStartdate(\DateTimeInterface $startdate): self
    {
        $this->startdate = $startdate;

        return $this;
    }

    public function getEnddate(): ?\DateTimeInterface
    {
        return $this->enddate;
    }

    public function setEnddate(\DateTimeInterface $enddate): self
    {
        $this->enddate = $enddate;

        return $this;
    }

    public function getActivationdue(): ?\DateTimeInterface
    {
        return $this->activationdue;
    }

    public function setActivationdue(?\DateTimeInterface $activationdue): self
    {
        $this->activationdue = $activationdue;

        return $this;
    }

    public function getDisplaydate(): ?\DateTimeInterface
    {
        return $this->displaydate;
    }

    public function setDisplaydate(\DateTimeInterface $displaydate): self
    {
        $this->displaydate = $displaydate;

        return $this;
    }

    public function getWeekname(): ?string
    {
        return $this->weekname;
    }

    public function setWeekname(?string $weekname): self
    {
        $this->weekname = $weekname;

        return $this;
    }


}
