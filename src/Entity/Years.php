<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Years
 *
 * @ORM\Table(name="years")
 * @ORM\Entity
 */
class Years
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="season", type="date", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $season;

    public function getSeason(): ?\DateTimeInterface
    {
        return $this->season;
    }


}
