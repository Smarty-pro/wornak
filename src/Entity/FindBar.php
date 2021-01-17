<?php

namespace App\Entity;

use App\Repository\FindBarRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FindBarRepository::class)
 */
class FindBar
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $studyLevel;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $training;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $location;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStudyLevel(): ?string
    {
        return $this->studyLevel;
    }

    public function setStudyLevel(string $studyLevel): self
    {
        $this->studyLevel = $studyLevel;

        return $this;
    }

    public function getTraining(): ?string
    {
        return $this->training;
    }

    public function setTraining(string $training): self
    {
        $this->training = $training;

        return $this;
    }

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function setLocation(string $location): self
    {
        $this->location = $location;

        return $this;
    }
}
