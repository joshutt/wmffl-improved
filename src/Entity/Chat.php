<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Chat
 *
 * @ORM\Table(name="chat")
 * @ORM\Entity
 */
class Chat
{
    /**
     * @var int
     *
     * @ORM\Column(name="messageId", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $messageid;

    /**
     * @var int
     *
     * @ORM\Column(name="userid", type="integer", nullable=false)
     */
    private $userid = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="message", type="string", length=255, nullable=false, options={"default"="''"})
     */
    private $message = '\'\'';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="time", type="datetime", nullable=false, options={"default"="current_timestamp()"})
     */
    private $time = 'current_timestamp()';

    public function getMessageid(): ?int
    {
        return $this->messageid;
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

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }

    public function getTime(): ?\DateTimeInterface
    {
        return $this->time;
    }

    public function setTime(\DateTimeInterface $time): self
    {
        $this->time = $time;

        return $this;
    }


}
