<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Expansionlost
 *
 * @ORM\Table(name="expansionlost")
 * @ORM\Entity
 */
class Expansionlost
{
    /**
     * @var int
     *
     * @ORM\Column(name="teamid", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $teamid;

    /**
     * @var int
     *
     * @ORM\Column(name="num", type="integer", nullable=false)
     */
    private $num;

    public function getTeamid(): ?int
    {
        return $this->teamid;
    }

    public function getNum(): ?int
    {
        return $this->num;
    }

    public function setNum(int $num): self
    {
        $this->num = $num;

        return $this;
    }


}
