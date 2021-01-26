<?php

namespace App\Entity;

use App\Repository\RequestsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RequestsRepository::class)
 */
class Requests
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="requests")
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity=JobPost::class, inversedBy="requests")
     */
    private $jobpost;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $status;

    /**
     * @ORM\Column(type="datetime")
     */
    private $publishedAt;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\ManyToOne(targetEntity=JobSeeker::class, inversedBy="requests")
     */
    private $jobSeeker;

    /**
     * @ORM\OneToOne(targetEntity=Company::class, inversedBy="requests", cascade={"persist", "remove"})
     */
    private $company;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getJobpost(): ?JobPost
    {
        return $this->jobpost;
    }

    public function setJobpost(?JobPost $jobpost): self
    {
        $this->jobpost = $jobpost;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getPublishedAt(): ?\DateTimeInterface
    {
        return $this->publishedAt;
    }

    public function setPublishedAt(\DateTimeInterface $publishedAt): self
    {
        $this->publishedAt = $publishedAt;

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

    public function getJobSeeker(): ?JobSeeker
    {
        return $this->jobSeeker;
    }

    public function setJobSeeker(?JobSeeker $jobSeeker): self
    {
        $this->jobSeeker = $jobSeeker;

        return $this;
    }

    public function getCompany(): ?Company
    {
        return $this->company;
    }

    public function setCompany(?Company $company): self
    {
        $this->company = $company;

        return $this;
    }
}
