<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Nflteams
 *
 * @ORM\Table(name="nflteams", indexes={@ORM\Index(name="name", columns={"name"})})
 * @ORM\Entity
 */
class Nflteams
{
    /**
     * @var string
     *
     * @ORM\Column(name="nflteam", type="string", length=3, nullable=false, options={"default"="''","fixed"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $nflteam = '\'\'';

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=25, nullable=false, options={"default"="''"})
     */
    private $name = '\'\'';

    /**
     * @var string
     *
     * @ORM\Column(name="nickname", type="string", length=20, nullable=false, options={"default"="''"})
     */
    private $nickname = '\'\'';

    public function getNflteam(): ?string
    {
        return $this->nflteam;
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

    public function getNickname(): ?string
    {
        return $this->nickname;
    }

    public function setNickname(string $nickname): self
    {
        $this->nickname = $nickname;

        return $this;
    }


}
