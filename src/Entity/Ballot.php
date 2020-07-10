<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ballot
 *
 * @ORM\Table(name="ballot")
 * @ORM\Entity
 */
class Ballot
{
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
     * @ORM\Column(name="IssueID", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $issueid = '0';

    /**
     * @var bool|null
     *
     * @ORM\Column(name="Result", type="boolean", nullable=true, options={"default"="NULL"})
     */
    private $result = 'NULL';

    /**
     * @var string|null
     *
     * @ORM\Column(name="Vote", type="string", length=0, nullable=true, options={"default"="'No Vote'"})
     */
    private $vote = '\'No Vote\'';

    public function getTeamid(): ?int
    {
        return $this->teamid;
    }

    public function getIssueid(): ?int
    {
        return $this->issueid;
    }

    public function getResult(): ?bool
    {
        return $this->result;
    }

    public function setResult(?bool $result): self
    {
        $this->result = $result;

        return $this;
    }

    public function getVote(): ?string
    {
        return $this->vote;
    }

    public function setVote(?string $vote): self
    {
        $this->vote = $vote;

        return $this;
    }


}
