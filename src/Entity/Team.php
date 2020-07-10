<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Team
 *
 * @ORM\Table(name="team", uniqueConstraints={@ORM\UniqueConstraint(name="Name", columns={"Name"}), @ORM\UniqueConstraint(name="abbrev", columns={"abbrev"}), @ORM\UniqueConstraint(name="TeamID_2", columns={"TeamID", "Name"})})
 * @ORM\Entity
 */
class Team
{
    /**
     * @var int
     *
     * @ORM\Column(name="TeamID", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $teamid;

    /**
     * @var int
     *
     * @ORM\Column(name="DivisionID", type="integer", nullable=false)
     */
    private $divisionid = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="Name", type="string", length=50, nullable=false, options={"default"="''"})
     */
    private $name = '\'\'';

    /**
     * @var int|null
     *
     * @ORM\Column(name="member", type="integer", nullable=true, options={"default"="NULL"})
     */
    private $member = 'NULL';

    /**
     * @var bool|null
     *
     * @ORM\Column(name="statid", type="boolean", nullable=true, options={"default"="NULL"})
     */
    private $statid = 'NULL';

    /**
     * @var string|null
     *
     * @ORM\Column(name="logo", type="string", length=50, nullable=true, options={"default"="NULL"})
     */
    private $logo = 'NULL';

    /**
     * @var bool
     *
     * @ORM\Column(name="fulllogo", type="boolean", nullable=false)
     */
    private $fulllogo = '0';

    /**
     * @var string|null
     *
     * @ORM\Column(name="motto", type="string", length=255, nullable=true, options={"default"="NULL"})
     */
    private $motto = 'NULL';

    /**
     * @var string|null
     *
     * @ORM\Column(name="abbrev", type="string", length=3, nullable=true, options={"default"="NULL","fixed"=true})
     */
    private $abbrev = 'NULL';

    /**
     * @var bool
     *
     * @ORM\Column(name="active", type="boolean", nullable=false, options={"default"="1"})
     */
    private $active = true;

    public function getTeamid(): ?int
    {
        return $this->teamid;
    }

    public function getDivisionid(): ?int
    {
        return $this->divisionid;
    }

    public function setDivisionid(int $divisionid): self
    {
        $this->divisionid = $divisionid;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getMember(): ?int
    {
        return $this->member;
    }

    public function setMember(?int $member): self
    {
        $this->member = $member;

        return $this;
    }

    public function getStatid(): ?bool
    {
        return $this->statid;
    }

    public function setStatid(?bool $statid): self
    {
        $this->statid = $statid;

        return $this;
    }

    public function getLogo(): ?string
    {
        return $this->logo;
    }

    public function setLogo(?string $logo): self
    {
        $this->logo = $logo;

        return $this;
    }

    public function getFulllogo(): ?bool
    {
        return $this->fulllogo;
    }

    public function setFulllogo(bool $fulllogo): self
    {
        $this->fulllogo = $fulllogo;

        return $this;
    }

    public function getMotto(): ?string
    {
        return $this->motto;
    }

    public function setMotto(?string $motto): self
    {
        $this->motto = $motto;

        return $this;
    }

    public function getAbbrev(): ?string
    {
        return $this->abbrev;
    }

    public function setAbbrev(?string $abbrev): self
    {
        $this->abbrev = $abbrev;

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


}
