<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Rankedvote
 *
 * @ORM\Table(name="rankedvote")
 * @ORM\Entity
 */
class Rankedvote
{
    /**
     * @var int
     *
     * @ORM\Column(name="issueid", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $issueid = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="choice", type="string", length=50, nullable=false, options={"default"="''"})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $choice = '\'\'';

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
     * @ORM\Column(name="rank", type="integer", nullable=false)
     */
    private $rank = '0';

    public function getIssueid(): ?int
    {
        return $this->issueid;
    }

    public function getChoice(): ?string
    {
        return $this->choice;
    }

    public function getTeamid(): ?int
    {
        return $this->teamid;
    }

    public function getRank(): ?int
    {
        return $this->rank;
    }

    public function setRank(int $rank): self
    {
        $this->rank = $rank;

        return $this;
    }


}
