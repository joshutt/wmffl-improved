<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Expansionprotections
 *
 * @ORM\Table(name="expansionprotections")
 * @ORM\Entity
 */
class Expansionprotections
{
    /**
     * @var int
     *
     * @ORM\Column(name="teamid", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $teamid;

    /**
     * @var int
     *
     * @ORM\Column(name="playerid", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $playerid;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=0, nullable=false)
     */
    private $type;

    /**
     * @var int
     *
     * @ORM\Column(name="protected", type="integer", nullable=false)
     */
    private $protected;

    public function getTeamid(): ?int
    {
        return $this->teamid;
    }

    public function getPlayerid(): ?int
    {
        return $this->playerid;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getProtected(): ?int
    {
        return $this->protected;
    }

    public function setProtected(int $protected): self
    {
        $this->protected = $protected;

        return $this;
    }


}
