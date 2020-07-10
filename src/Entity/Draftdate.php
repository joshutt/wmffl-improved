<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Draftdate
 *
 * @ORM\Table(name="draftdate")
 * @ORM\Entity
 */
class Draftdate
{
    /**
     * @var int
     *
     * @ORM\Column(name="UserID", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $userid = '0';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Date", type="date", nullable=false, options={"default"="'0000-00-00'"})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $date = '\'0000-00-00\'';

    /**
     * @var string
     *
     * @ORM\Column(name="Attend", type="string", length=0, nullable=false, options={"default"="'Y'"})
     */
    private $attend = '\'Y\'';

    public function getUserid(): ?int
    {
        return $this->userid;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function getAttend(): ?string
    {
        return $this->attend;
    }

    public function setAttend(string $attend): self
    {
        $this->attend = $attend;

        return $this;
    }


}
