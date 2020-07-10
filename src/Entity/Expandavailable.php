<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Expandavailable
 *
 * @ORM\Table(name="expandavailable")
 * @ORM\Entity
 */
class Expandavailable
{
    /**
     * @var bool
     *
     * @ORM\Column(name="id", type="boolean", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var bool
     *
     * @ORM\Column(name="playerid", type="boolean", nullable=false)
     */
    private $playerid;

    /**
     * @var bool
     *
     * @ORM\Column(name="teamid", type="boolean", nullable=false)
     */
    private $teamid;

    /**
     * @var bool
     *
     * @ORM\Column(name="firstname", type="boolean", nullable=false)
     */
    private $firstname;

    /**
     * @var bool
     *
     * @ORM\Column(name="lastname", type="boolean", nullable=false)
     */
    private $lastname;

    /**
     * @var bool
     *
     * @ORM\Column(name="pos", type="boolean", nullable=false)
     */
    private $pos;

    /**
     * @var bool
     *
     * @ORM\Column(name="type", type="boolean", nullable=false)
     */
    private $type;

    /**
     * @var bool
     *
     * @ORM\Column(name="cost", type="boolean", nullable=false)
     */
    private $cost;

    public function getId(): ?bool
    {
        return $this->id;
    }

    public function getPlayerid(): ?bool
    {
        return $this->playerid;
    }

    public function setPlayerid(bool $playerid): self
    {
        $this->playerid = $playerid;

        return $this;
    }

    public function getTeamid(): ?bool
    {
        return $this->teamid;
    }

    public function setTeamid(bool $teamid): self
    {
        $this->teamid = $teamid;

        return $this;
    }

    public function getFirstname(): ?bool
    {
        return $this->firstname;
    }

    public function setFirstname(bool $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?bool
    {
        return $this->lastname;
    }

    public function setLastname(bool $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getPos(): ?bool
    {
        return $this->pos;
    }

    public function setPos(bool $pos): self
    {
        $this->pos = $pos;

        return $this;
    }

    public function getType(): ?bool
    {
        return $this->type;
    }

    public function setType(bool $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getCost(): ?bool
    {
        return $this->cost;
    }

    public function setCost(bool $cost): self
    {
        $this->cost = $cost;

        return $this;
    }


}
