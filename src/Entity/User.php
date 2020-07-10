<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Table(name="user", uniqueConstraints={@ORM\UniqueConstraint(name="Username_2", columns={"Username"})})
 * @ORM\Entity
 */
class User
{
    /**
     * @var int
     *
     * @ORM\Column(name="UserID", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $userid;

    /**
     * @var int|null
     *
     * @ORM\Column(name="TeamID", type="integer", nullable=true, options={"default"="NULL"})
     */
    private $teamid = 'NULL';

    /**
     * @var string
     *
     * @ORM\Column(name="Username", type="string", length=20, nullable=false, options={"default"="''"})
     */
    private $username = '\'\'';

    /**
     * @var string
     *
     * @ORM\Column(name="Password", type="string", length=50, nullable=false, options={"default"="''"})
     */
    private $password = '\'\'';

    /**
     * @var string|null
     *
     * @ORM\Column(name="Name", type="string", length=50, nullable=true, options={"default"="NULL"})
     */
    private $name = 'NULL';

    /**
     * @var string
     *
     * @ORM\Column(name="Email", type="string", length=75, nullable=false, options={"default"="''"})
     */
    private $email = '\'\'';

    /**
     * @var bool
     *
     * @ORM\Column(name="primaryowner", type="boolean", nullable=false)
     */
    private $primaryowner = '0';

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="lastlog", type="datetime", nullable=true, options={"default"="NULL"})
     */
    private $lastlog = 'NULL';

    /**
     * @var string|null
     *
     * @ORM\Column(name="blogaddress", type="string", length=75, nullable=true, options={"default"="NULL"})
     */
    private $blogaddress = 'NULL';

    /**
     * @var string
     *
     * @ORM\Column(name="active", type="string", length=0, nullable=false, options={"default"="'Y'"})
     */
    private $active = '\'Y\'';

    /**
     * @var bool
     *
     * @ORM\Column(name="commish", type="boolean", nullable=false)
     */
    private $commish = '0';

    public function getUserid(): ?int
    {
        return $this->userid;
    }

    public function getTeamid(): ?int
    {
        return $this->teamid;
    }

    public function setTeamid(?int $teamid): self
    {
        $this->teamid = $teamid;

        return $this;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPrimaryowner(): ?bool
    {
        return $this->primaryowner;
    }

    public function setPrimaryowner(bool $primaryowner): self
    {
        $this->primaryowner = $primaryowner;

        return $this;
    }

    public function getLastlog(): ?\DateTimeInterface
    {
        return $this->lastlog;
    }

    public function setLastlog(?\DateTimeInterface $lastlog): self
    {
        $this->lastlog = $lastlog;

        return $this;
    }

    public function getBlogaddress(): ?string
    {
        return $this->blogaddress;
    }

    public function setBlogaddress(?string $blogaddress): self
    {
        $this->blogaddress = $blogaddress;

        return $this;
    }

    public function getActive(): ?string
    {
        return $this->active;
    }

    public function setActive(string $active): self
    {
        $this->active = $active;

        return $this;
    }

    public function getCommish(): ?bool
    {
        return $this->commish;
    }

    public function setCommish(bool $commish): self
    {
        $this->commish = $commish;

        return $this;
    }


}
