<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TagRepository")
 */
class Tag
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\article", inversedBy="tags")
     */
    private $artciles;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    public function __construct()
    {
        $this->artciles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|article[]
     */
    public function getArtciles(): Collection
    {
        return $this->artciles;
    }

    public function addArtcile(article $artcile): self
    {
        if (!$this->artciles->contains($artcile)) {
            $this->artciles[] = $artcile;
        }

        return $this;
    }

    public function removeArtcile(article $artcile): self
    {
        if ($this->artciles->contains($artcile)) {
            $this->artciles->removeElement($artcile);
        }

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }
}
