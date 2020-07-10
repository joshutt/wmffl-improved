<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Schedule
 *
 * @ORM\Table(name="schedule", indexes={@ORM\Index(name="Season", columns={"Season", "Week"})})
 * @ORM\Entity
 */
class Schedule
{
    /**
     * @var int
     *
     * @ORM\Column(name="gameid", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $gameid;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Season", type="date", nullable=false, options={"default"="0000"})
     */
    private $season = '0000';

    /**
     * @var bool
     *
     * @ORM\Column(name="Week", type="boolean", nullable=false)
     */
    private $week = '0';

    /**
     * @var string|null
     *
     * @ORM\Column(name="label", type="string", length=255, nullable=true, options={"default"="NULL"})
     */
    private $label = 'NULL';

    /**
     * @var int
     *
     * @ORM\Column(name="TeamA", type="integer", nullable=false)
     */
    private $teama = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="TeamB", type="integer", nullable=false)
     */
    private $teamb = '0';

    /**
     * @var int|null
     *
     * @ORM\Column(name="scorea", type="integer", nullable=true, options={"default"="NULL"})
     */
    private $scorea = 'NULL';

    /**
     * @var int|null
     *
     * @ORM\Column(name="scoreb", type="integer", nullable=true, options={"default"="NULL"})
     */
    private $scoreb = 'NULL';

    /**
     * @var bool
     *
     * @ORM\Column(name="overtime", type="boolean", nullable=false)
     */
    private $overtime = '0';

    /**
     * @var bool
     *
     * @ORM\Column(name="playoffs", type="boolean", nullable=false)
     */
    private $playoffs = '0';

    /**
     * @var bool
     *
     * @ORM\Column(name="postseason", type="boolean", nullable=false)
     */
    private $postseason = '0';

    /**
     * @var bool
     *
     * @ORM\Column(name="championship", type="boolean", nullable=false)
     */
    private $championship = '0';

    public function getGameid(): ?int
    {
        return $this->gameid;
    }

    public function getSeason(): ?\DateTimeInterface
    {
        return $this->season;
    }

    public function setSeason(\DateTimeInterface $season): self
    {
        $this->season = $season;

        return $this;
    }

    public function getWeek(): ?bool
    {
        return $this->week;
    }

    public function setWeek(bool $week): self
    {
        $this->week = $week;

        return $this;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(?string $label): self
    {
        $this->label = $label;

        return $this;
    }

    public function getTeama(): ?int
    {
        return $this->teama;
    }

    public function setTeama(int $teama): self
    {
        $this->teama = $teama;

        return $this;
    }

    public function getTeamb(): ?int
    {
        return $this->teamb;
    }

    public function setTeamb(int $teamb): self
    {
        $this->teamb = $teamb;

        return $this;
    }

    public function getScorea(): ?int
    {
        return $this->scorea;
    }

    public function setScorea(?int $scorea): self
    {
        $this->scorea = $scorea;

        return $this;
    }

    public function getScoreb(): ?int
    {
        return $this->scoreb;
    }

    public function setScoreb(?int $scoreb): self
    {
        $this->scoreb = $scoreb;

        return $this;
    }

    public function getOvertime(): ?bool
    {
        return $this->overtime;
    }

    public function setOvertime(bool $overtime): self
    {
        $this->overtime = $overtime;

        return $this;
    }

    public function getPlayoffs(): ?bool
    {
        return $this->playoffs;
    }

    public function setPlayoffs(bool $playoffs): self
    {
        $this->playoffs = $playoffs;

        return $this;
    }

    public function getPostseason(): ?bool
    {
        return $this->postseason;
    }

    public function setPostseason(bool $postseason): self
    {
        $this->postseason = $postseason;

        return $this;
    }

    public function getChampionship(): ?bool
    {
        return $this->championship;
    }

    public function setChampionship(bool $championship): self
    {
        $this->championship = $championship;

        return $this;
    }


}
