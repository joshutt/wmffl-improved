<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Transpoints
 *
 * @ORM\Table(name="transpoints")
 * @ORM\Entity
 */
class Transpoints
{
    /**
     * @var int
     *
     * @ORM\Column(name="season", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $season = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="TeamID", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $teamid = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="ProtectionPts", type="integer", nullable=false)
     */
    private $protectionpts = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="TransPts", type="integer", nullable=false)
     */
    private $transpts = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="TotalPts", type="integer", nullable=false)
     */
    private $totalpts = '0';

    public function getSeason(): ?int
    {
        return $this->season;
    }

    public function getTeamid(): ?int
    {
        return $this->teamid;
    }

    public function getProtectionpts(): ?int
    {
        return $this->protectionpts;
    }

    public function setProtectionpts(int $protectionpts): self
    {
        $this->protectionpts = $protectionpts;

        return $this;
    }

    public function getTranspts(): ?int
    {
        return $this->transpts;
    }

    public function setTranspts(int $transpts): self
    {
        $this->transpts = $transpts;

        return $this;
    }

    public function getTotalpts(): ?int
    {
        return $this->totalpts;
    }

    public function setTotalpts(int $totalpts): self
    {
        $this->totalpts = $totalpts;

        return $this;
    }


}
