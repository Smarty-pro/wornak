<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\JobPostRepository")
 */
class JobPost
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;


    /**
     * @ORM\Column(type="string", length=255)
     */
    private $jobTitle;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $uid;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $jobZone;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $training;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $contractType;

    /**
     * @ORM\Column(type="datetime")
     */
    private $publishedAt;

    /**
     * @ORM\Column(type="date")
     */
    private $ExpDate;

    /**
     * @ORM\Column(type="integer")
     */
    private $Salary;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Sector;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $StudyLevelRequired;

    /**
     * @ORM\ManyToMany(targetEntity=JobSeeker::class, mappedBy="jobPosts")
     */
    private $jobSeekers;

    /**
     * @ORM\OneToMany(targetEntity=Requests::class, mappedBy="jobpost")
     */
    private $requests;

    /**
     * @ORM\ManyToOne(targetEntity=Company::class, inversedBy="jobPosts")
     */
    private $company;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $employerName;


    public function __construct()
    {
        $this->jobSeekers = new ArrayCollection();
        $this->requests = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCompany(): Company
    {
        return $this->company;
    }

    public function setCompany(Company $Company): self
    {
        $this->company = $Company;

        return $this;
    }

    public function getJobTitle(): ?string
    {
        return $this->jobTitle;
    }

    public function setJobTitle(string $jobTitle): self
    {
        $this->jobTitle = $jobTitle;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getUid(): ?string
    {
        return $this->uid;
    }

    public function setUid(string $uid): self
    {
        $this->uid = $uid;

        return $this;
    }

    public function getJobZone(): ?string
    {
        return $this->jobZone;
    }

    public function setJobZone(string $jobZone): self
    {
        $this->jobZone = $jobZone;

        return $this;
    }

    public function getTraining(): ?string
    {
        return $this->training;
    }

    public function setTraining(?string $training): self
    {
        $this->training = $training;

        return $this;
    }

    public function getContractType(): ?string
    {
        return $this->contractType;
    }

    public function setContractType(string $contractType): self
    {
        $this->contractType = $contractType;

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

    public function getExpDate(): ?\DateTimeInterface
    {
        return $this->ExpDate;
    }

    public function setExpDate(\DateTimeInterface $ExpDate): self
    {
        $this->ExpDate = $ExpDate;

        return $this;
    }

    public function getSalary(): ?int
    {
        return $this->Salary;
    }

    public function setSalary(int $Salary): self
    {
        $this->Salary = $Salary;

        return $this;
    }

    public function getSector(): ?string
    {
        return $this->Sector;
    }

    public function setSector(string $Sector): self
    {
        $this->Sector = $Sector;

        return $this;
    }

    public function getStudyLevelRequired(): ?string
    {
        return $this->StudyLevelRequired;
    }

    public function setStudyLevelRequired(string $StudyLevelRequired): self
    {
        $this->StudyLevelRequired = $StudyLevelRequired;

        return $this;
    }

    /**
     * @return Collection|JobSeeker[]
     */
    public function getJobSeekers(): Collection
    {
        return $this->jobSeekers;
    }

    public function addJobSeeker(JobSeeker $jobSeeker): self
    {
        if (!$this->jobSeekers->contains($jobSeeker)) {
            $this->jobSeekers[] = $jobSeeker;
            $jobSeeker->addJobPost($this);
        }

        return $this;
    }

    public function removeJobSeeker(JobSeeker $jobSeeker): self
    {
        if ($this->jobSeekers->removeElement($jobSeeker)) {
            $jobSeeker->removeJobPost($this);
        }

        return $this;
    }

    /**
     * @return Collection|Requests[]
     */
    public function getRequests(): Collection
    {
        return $this->requests;
    }

    public function addRequest(Requests $request): self
    {
        if (!$this->requests->contains($request)) {
            $this->requests[] = $request;
            $request->setJobpost($this);
        }

        return $this;
    }

    public function removeRequest(Requests $request): self
    {
        if ($this->requests->removeElement($request)) {
            // set the owning side to null (unless already changed)
            if ($request->getJobpost() === $this) {
                $request->setJobpost(null);
            }
        }

        return $this;
    }

    public function getEmployerName(): ?string
    {
        return $this->employerName;
    }

    public function setEmployerName(string $employerName): self
    {
        $this->employerName = $employerName;

        return $this;
    }
}
