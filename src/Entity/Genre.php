<?php

namespace App\Entity;

use App\Repository\GenreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GenreRepository::class)]
class Genre
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\ManyToOne(targetEntity: self::class, inversedBy: 'genres')]
    #[ORM\JoinColumn(nullable: false)]
    private ?self $album = null;

    /**
     * @var Collection<int, self>
     */
    #[ORM\OneToMany(targetEntity: self::class, mappedBy: 'album')]
    private Collection $genres;

    public function __construct()
    {
        $this->genres = new ArrayCollection();
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

    public function getAlbum(): ?self
    {
        return $this->album;
    }

    public function setAlbum(?self $album): static
    {
        $this->album = $album;

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getGenres(): Collection
    {
        return $this->genres;
    }

    public function addGenre(self $genre): static
    {
        if (!$this->genres->contains($genre)) {
            $this->genres->add($genre);
            $genre->setAlbum($this);
        }

        return $this;
    }

    public function removeGenre(self $genre): static
    {
        if ($this->genres->removeElement($genre)) {
            // set the owning side to null (unless already changed)
            if ($genre->getAlbum() === $this) {
                $genre->setAlbum(null);
            }
        }

        return $this;
    }
}
