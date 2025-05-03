<?php

namespace App\Entity;

use App\Repository\BandRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BandRepository::class)]
class Band
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $biography = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateCreated = null;

    #[ORM\Column(length: 255)]
    private ?string $image = null;

    #[ORM\ManyToOne(targetEntity: self::class, inversedBy: 'categorizations')]
    #[ORM\JoinColumn(nullable: false)]
    private ?self $categorizations = null;

    public function __construct()
    {
        $this->categorizations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getBiography(): ?string
    {
        return $this->biography;
    }

    public function setBiography(string $biography): static
    {
        $this->biography = $biography;

        return $this;
    }

    public function getDateCreated(): ?\DateTimeInterface
    {
        return $this->dateCreated;
    }

    public function setDateCreated(\DateTimeInterface $dateCreated): static
    {
        $this->dateCreated = $dateCreated;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function getCategorizations(): ?self
    {
        return $this->categorizations;
    }

    public function setCategorizations(?self $categorizations): static
    {
        $this->categorizations = $categorizations;

        return $this;
    }

    public function addCategorization(self $categorization): static
    {
        if (!$this->categorizations->contains($categorization)) {
            $this->categorizations->add($categorization);
            $categorization->setCategorizations($this);
        }

        return $this;
    }

    public function removeCategorization(self $categorization): static
    {
        if ($this->categorizations->removeElement($categorization)) {
            // set the owning side to null (unless already changed)
            if ($categorization->getCategorizations() === $this) {
                $categorization->setCategorizations(null);
            }
        }

        return $this;
    }
}