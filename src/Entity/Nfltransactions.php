<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Nfltransactions
 *
 * @ORM\Table(name="nfltransactions")
 * @ORM\Entity
 */
class Nfltransactions
{
    /**
     * @var int
     *
     * @ORM\Column(name="playerid", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $playerid = '0';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="transdate", type="date", nullable=false, options={"default"="'0000-00-00'"})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $transdate = '\'0000-00-00\'';

    /**
     * @var string
     *
     * @ORM\Column(name="action", type="string", length=0, nullable=false, options={"default"="'Unknown'"})
     */
    private $action = '\'Unknown\'';

    /**
     * @var string|null
     *
     * @ORM\Column(name="team", type="string", length=3, nullable=true, options={"default"="NULL","fixed"=true})
     */
    private $team = 'NULL';

    /**
     * @var int|null
     *
     * @ORM\Column(name="flag", type="integer", nullable=true, options={"default"="NULL"})
     */
    private $flag = 'NULL';

    public function getPlayerid(): ?int
    {
        return $this->playerid;
    }

    public function getTransdate(): ?\DateTimeInterface
    {
        return $this->transdate;
    }

    public function getAction(): ?string
    {
        return $this->action;
    }

    public function setAction(string $action): self
    {
        $this->action = $action;

        return $this;
    }

    public function getTeam(): ?string
    {
        return $this->team;
    }

    public function setTeam(?string $team): self
    {
        $this->team = $team;

        return $this;
    }

    public function getFlag(): ?int
    {
        return $this->flag;
    }

    public function setFlag(?int $flag): self
    {
        $this->flag = $flag;

        return $this;
    }


}
