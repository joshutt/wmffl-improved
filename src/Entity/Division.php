<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Division
 *
 * @ORM\Table(name="division", uniqueConstraints={@ORM\UniqueConstraint(name="Name", columns={"Name"})})
 * @ORM\Entity
 */
class Division
{
    /**
     * @var int
     *
     * @ORM\Column(name="DivisionID", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $divisionid;

    /**
     * @var string
     *
     * @ORM\Column(name="Name", type="string", length=30, nullable=false, options={"default"="''"})
     */
    private $name = '\'\'';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="startYear", type="date", nullable=false, options={"default"="0000"})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $startyear = '0000';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="endYear", type="date", nullable=false, options={"default"="0000"})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $endyear = '0000';

    public function getDivisionid(): ?int
    {
        return $this->divisionid;
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

    public function getStartyear(): ?\DateTimeInterface
    {
        return $this->startyear;
    }

    public function getEndyear(): ?\DateTimeInterface
    {
        return $this->endyear;
    }


}
