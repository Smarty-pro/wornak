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
}
