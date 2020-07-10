<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Newplayers
 *
 * @ORM\Table(name="newplayers", uniqueConstraints={@ORM\UniqueConstraint(name="flmid", columns={"flmid"}), @ORM\UniqueConstraint(name="unique_nfldb_id", columns={"nfldb_id"})})
 * @ORM\Entity
 */
class Newplayers
{
    /**
     * @var int
     *
     * @ORM\Column(name="playerid", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $playerid;

    /**
     * @var int
     *
     * @ORM\Column(name="flmid", type="integer", nullable=false)
     */
    private $flmid = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="lastname", type="string", length=25, nullable=false, options={"default"="''"})
     */
    private $lastname = '\'\'';

    /**
     * @var string|null
     *
     * @ORM\Column(name="firstname", type="string", length=25, nullable=true, options={"default"="NULL"})
     */
    private $firstname = 'NULL';

    /**
     * @var string|null
     *
     * @ORM\Column(name="pos", type="string", length=0, nullable=true, options={"default"="NULL"})
     */
    private $pos = 'NULL';

    /**
     * @var string|null
     *
     * @ORM\Column(name="team", type="string", length=3, nullable=true, options={"default"="NULL","fixed"=true})
     */
    private $team = 'NULL';

    /**
     * @var int|null
     *
     * @ORM\Column(name="number", type="integer", nullable=true, options={"default"="NULL"})
     */
    private $number = 'NULL';

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="retired", type="date", nullable=true, options={"default"="NULL"})
     */
    private $retired = 'NULL';

    /**
     * @var int|null
     *
     * @ORM\Column(name="height", type="integer", nullable=true, options={"default"="NULL"})
     */
    private $height = 'NULL';

    /**
     * @var int|null
     *
     * @ORM\Column(name="weight", type="integer", nullable=true, options={"default"="NULL"})
     */
    private $weight = 'NULL';

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="dob", type="date", nullable=true, options={"default"="NULL"})
     */
    private $dob = 'NULL';

    /**
     * @var string|null
     *
     * @ORM\Column(name="draftTeam", type="string", length=3, nullable=true, options={"default"="NULL","fixed"=true})
     */
    private $draftteam = 'NULL';

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="draftYear", type="date", nullable=true, options={"default"="NULL"})
     */
    private $draftyear = 'NULL';

    /**
     * @var int|null
     *
     * @ORM\Column(name="draftRound", type="integer", nullable=true, options={"default"="NULL"})
     */
    private $draftround = 'NULL';

    /**
     * @var int|null
     *
     * @ORM\Column(name="draftPick", type="integer", nullable=true, options={"default"="NULL"})
     */
    private $draftpick = 'NULL';

    /**
     * @var bool
     *
     * @ORM\Column(name="active", type="boolean", nullable=false)
     */
    private $active = '0';

    /**
     * @var bool
     *
     * @ORM\Column(name="usePos", type="boolean", nullable=false, options={"default"="1"})
     */
    private $usepos = true;

    /**
     * @var int|null
     *
     * @ORM\Column(name="nflid", type="integer", nullable=true, options={"default"="NULL"})
     */
    private $nflid = 'NULL';

    /**
     * @var string|null
     *
     * @ORM\Column(name="nfldb_id", type="string", length=10, nullable=true, options={"default"="NULL"})
     */
    private $nfldbId = 'NULL';

    public function getPlayerid(): ?int
    {
        return $this->playerid;
    }

    public function getFlmid(): ?int
    {
        return $this->flmid;
    }

    public function setFlmid(int $flmid): self
    {
        $this->flmid = $flmid;

        return $this;
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

    public function setFirstname(?string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getPos(): ?string
    {
        return $this->pos;
    }

    public function setPos(?string $pos): self
    {
        $this->pos = $pos;

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

    public function getNumber(): ?int
    {
        return $this->number;
    }

    public function setNumber(?int $number): self
    {
        $this->number = $number;

        return $this;
    }

    public function getRetired(): ?\DateTimeInterface
    {
        return $this->retired;
    }

    public function setRetired(?\DateTimeInterface $retired): self
    {
        $this->retired = $retired;

        return $this;
    }

    public function getHeight(): ?int
    {
        return $this->height;
    }

    public function setHeight(?int $height): self
    {
        $this->height = $height;

        return $this;
    }

    public function getWeight(): ?int
    {
        return $this->weight;
    }

    public function setWeight(?int $weight): self
    {
        $this->weight = $weight;

        return $this;
    }

    public function getDob(): ?\DateTimeInterface
    {
        return $this->dob;
    }

    public function setDob(?\DateTimeInterface $dob): self
    {
        $this->dob = $dob;

        return $this;
    }

    public function getDraftteam(): ?string
    {
        return $this->draftteam;
    }

    public function setDraftteam(?string $draftteam): self
    {
        $this->draftteam = $draftteam;

        return $this;
    }

    public function getDraftyear(): ?\DateTimeInterface
    {
        return $this->draftyear;
    }

    public function setDraftyear(?\DateTimeInterface $draftyear): self
    {
        $this->draftyear = $draftyear;

        return $this;
    }

    public function getDraftround(): ?int
    {
        return $this->draftround;
    }

    public function setDraftround(?int $draftround): self
    {
        $this->draftround = $draftround;

        return $this;
    }

    public function getDraftpick(): ?int
    {
        return $this->draftpick;
    }

    public function setDraftpick(?int $draftpick): self
    {
        $this->draftpick = $draftpick;

        return $this;
    }

    public function getActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(bool $active): self
    {
        $this->active = $active;

        return $this;
    }

    public function getUsepos(): ?bool
    {
        return $this->usepos;
    }

    public function setUsepos(bool $usepos): self
    {
        $this->usepos = $usepos;

        return $this;
    }

    public function getNflid(): ?int
    {
        return $this->nflid;
    }

    public function setNflid(?int $nflid): self
    {
        $this->nflid = $nflid;

        return $this;
    }

    public function getNfldbId(): ?string
    {
        return $this->nfldbId;
    }

    public function setNfldbId(?string $nfldbId): self
    {
        $this->nfldbId = $nfldbId;

        return $this;
    }


}
