<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Players
 *
 * @ORM\Table(name="players")
 * @ORM\Entity
 */
class Players
{
    /**
     * @var int
     *
     * @ORM\Column(name="PlayerID", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $playerid;

    /**
     * @var string
     *
     * @ORM\Column(name="LastName", type="string", length=30, nullable=false, options={"default"="''"})
     */
    private $lastname = '\'\'';

    /**
     * @var string
     *
     * @ORM\Column(name="FirstName", type="string", length=30, nullable=false, options={"default"="''"})
     */
    private $firstname = '\'\'';

    /**
     * @var string|null
     *
     * @ORM\Column(name="NFLTeam", type="string", length=5, nullable=true, options={"default"="NULL"})
     */
    private $nflteam = 'NULL';

    /**
     * @var string|null
     *
     * @ORM\Column(name="Position", type="string", length=0, nullable=true, options={"default"="NULL"})
     */
    private $position = 'NULL';

    /**
     * @var string|null
     *
     * @ORM\Column(name="Status", type="string", length=1, nullable=true, options={"default"="NULL","fixed"=true})
     */
    private $status = 'NULL';

    /**
     * @var string|null
     *
     * @ORM\Column(name="StatID", type="string", length=5, nullable=true, options={"default"="'0'"})
     */
    private $statid = '\'0\'';

    public function getPlayerid(): ?int
    {
        return $this->playerid;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getNflteam(): ?string
    {
        return $this->nflteam;
    }

    public function setNflteam(?string $nflteam): self
    {
        $this->nflteam = $nflteam;

        return $this;
    }

    public function getPosition(): ?string
    {
        return $this->position;
    }

    public function setPosition(?string $position): self
    {
        $this->position = $position;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getStatid(): ?string
    {
        return $this->statid;
    }

    public function setStatid(?string $statid): self
    {
        $this->statid = $statid;

        return $this;
    }


}
