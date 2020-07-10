<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Issues
 *
 * @ORM\Table(name="issues", indexes={@ORM\Index(name="IssueID", columns={"IssueID", "IssueNum"})})
 * @ORM\Entity
 */
class Issues
{
    /**
     * @var int
     *
     * @ORM\Column(name="IssueID", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $issueid;

    /**
     * @var string
     *
     * @ORM\Column(name="IssueNum", type="string", length=10, nullable=false, options={"default"="''"})
     */
    private $issuenum = '\'\'';

    /**
     * @var string
     *
     * @ORM\Column(name="IssueName", type="string", length=40, nullable=false)
     */
    private $issuename;

    /**
     * @var int
     *
     * @ORM\Column(name="Sponsor", type="integer", nullable=false)
     */
    private $sponsor = '0';

    /**
     * @var string|null
     *
     * @ORM\Column(name="Description", type="text", length=255, nullable=true, options={"default"="NULL"})
     */
    private $description = 'NULL';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Season", type="date", nullable=false, options={"default"="0000"})
     */
    private $season = '0000';

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="Deadline", type="date", nullable=true, options={"default"="NULL"})
     */
    private $deadline = 'NULL';

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="StartDate", type="date", nullable=true, options={"default"="NULL"})
     */
    private $startdate = 'NULL';

    /**
     * @var string|null
     *
     * @ORM\Column(name="Result", type="string", length=10, nullable=true, options={"default"="NULL"})
     */
    private $result = 'NULL';

    public function getIssueid(): ?int
    {
        return $this->issueid;
    }

    public function getIssuenum(): ?string
    {
        return $this->issuenum;
    }

    public function setIssuenum(string $issuenum): self
    {
        $this->issuenum = $issuenum;

        return $this;
    }

    public function getIssuename(): ?string
    {
        return $this->issuename;
    }

    public function setIssuename(string $issuename): self
    {
        $this->issuename = $issuename;

        return $this;
    }

    public function getSponsor(): ?int
    {
        return $this->sponsor;
    }

    public function setSponsor(int $sponsor): self
    {
        $this->sponsor = $sponsor;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getSeason(): ?\DateTimeInterface
    {
        return $this->season;
    }

    public function setSeason(\DateTimeInterface $season): self
    {
        $this->season = $season;

        return $this;
    }

    public function getDeadline(): ?\DateTimeInterface
    {
        return $this->deadline;
    }

    public function setDeadline(?\DateTimeInterface $deadline): self
    {
        $this->deadline = $deadline;

        return $this;
    }

    public function getStartdate(): ?\DateTimeInterface
    {
        return $this->startdate;
    }

    public function setStartdate(?\DateTimeInterface $startdate): self
    {
        $this->startdate = $startdate;

        return $this;
    }

    public function getResult(): ?string
    {
        return $this->result;
    }

    public function setResult(?string $result): self
    {
        $this->result = $result;

        return $this;
    }


}
