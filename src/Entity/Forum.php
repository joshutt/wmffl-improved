<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Forum
 *
 * @ORM\Table(name="forum")
 * @ORM\Entity
 */
class Forum
{
    /**
     * @var int
     *
     * @ORM\Column(name="forumid", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $forumid;

    /**
     * @var int
     *
     * @ORM\Column(name="userid", type="integer", nullable=false)
     */
    private $userid = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=false, options={"default"="''"})
     */
    private $title = '\'\'';

    /**
     * @var string
     *
     * @ORM\Column(name="body", type="text", length=65535, nullable=false)
     */
    private $body;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createTime", type="datetime", nullable=false, options={"default"="'0000-00-00 00:00:00'"})
     */
    private $createtime = '\'0000-00-00 00:00:00\'';

    public function getForumid(): ?int
    {
        return $this->forumid;
    }

    public function getUserid(): ?int
    {
        return $this->userid;
    }

    public function setUserid(int $userid): self
    {
        $this->userid = $userid;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getBody(): ?string
    {
        return $this->body;
    }

    public function setBody(string $body): self
    {
        $this->body = $body;

        return $this;
    }

    public function getCreatetime(): ?\DateTimeInterface
    {
        return $this->createtime;
    }

    public function setCreatetime(\DateTimeInterface $createtime): self
    {
        $this->createtime = $createtime;

        return $this;
    }


}
