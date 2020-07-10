<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Articles
 *
 * @ORM\Table(name="articles")
 * @ORM\Entity
 */
class Articles
{
    /**
     * @var int
     *
     * @ORM\Column(name="articleId", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $articleid;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=75, nullable=false, options={"default"="''"})
     */
    private $title = '\'\'';

    /**
     * @var string|null
     *
     * @ORM\Column(name="link", type="string", length=255, nullable=true, options={"default"="NULL"})
     */
    private $link = 'NULL';

    /**
     * @var string|null
     *
     * @ORM\Column(name="caption", type="string", length=255, nullable=true, options={"default"="NULL"})
     */
    private $caption = 'NULL';

    /**
     * @var string|null
     *
     * @ORM\Column(name="location", type="string", length=50, nullable=true, options={"default"="NULL"})
     */
    private $location = 'NULL';

    /**
     * @var string|null
     *
     * @ORM\Column(name="articleText", type="text", length=65535, nullable=true, options={"default"="NULL"})
     */
    private $articletext = 'NULL';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="displayDate", type="datetime", nullable=false, options={"default"="'0000-00-00 00:00:00'"})
     */
    private $displaydate = '\'0000-00-00 00:00:00\'';

    /**
     * @var bool
     *
     * @ORM\Column(name="active", type="boolean", nullable=false)
     */
    private $active = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="priority", type="integer", nullable=false)
     */
    private $priority = '0';

    /**
     * @var int|null
     *
     * @ORM\Column(name="author", type="integer", nullable=true, options={"default"="NULL"})
     */
    private $author = 'NULL';

    public function getArticleid(): ?int
    {
        return $this->articleid;
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

    public function getLink(): ?string
    {
        return $this->link;
    }

    public function setLink(?string $link): self
    {
        $this->link = $link;

        return $this;
    }

    public function getCaption(): ?string
    {
        return $this->caption;
    }

    public function setCaption(?string $caption): self
    {
        $this->caption = $caption;

        return $this;
    }

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function setLocation(?string $location): self
    {
        $this->location = $location;

        return $this;
    }

    public function getArticletext(): ?string
    {
        return $this->articletext;
    }

    public function setArticletext(?string $articletext): self
    {
        $this->articletext = $articletext;

        return $this;
    }

    public function getDisplaydate(): ?\DateTimeInterface
    {
        return $this->displaydate;
    }

    public function setDisplaydate(\DateTimeInterface $displaydate): self
    {
        $this->displaydate = $displaydate;

        return $this;
    }

    public function getActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(bool $active): self
    {
        $this->active = $active;

        return $this;
    }

    public function getPriority(): ?int
    {
        return $this->priority;
    }

    public function setPriority(int $priority): self
    {
        $this->priority = $priority;

        return $this;
    }

    public function getAuthor(): ?int
    {
        return $this->author;
    }

    public function setAuthor(?int $author): self
    {
        $this->author = $author;

        return $this;
    }


}
