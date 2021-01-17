<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SearchBarRepository")
 */
class SearchBar
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
    private $searchContent;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $location;

    /**
     * @ORM\ManyToOne(targetEntity=JobSeeker::class, inversedBy="searchs")
     */
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSearchContent(): ?string
    {
        return $this->searchContent;
    }

    public function setSearchContent(string $searchContent): self
    {
        $this->searchContent = $searchContent;

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

    public function getUser(): ?JobSeeker
    {
        return $this->user;
    }

    public function setUser(?JobSeeker $user): self
    {
        $this->user = $user;

        return $this;
    }
}
