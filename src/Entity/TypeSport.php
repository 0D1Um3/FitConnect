<?php

namespace App\Entity;

use App\Repository\TypeSportRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TypeSportRepository::class)]
class TypeSport
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $sportName = null;

    /**
     * @var Collection<int, Sections>
     */
    #[ORM\OneToMany(targetEntity: Sections::class, mappedBy: 'typesSport')]
    private Collection $sections;

    #[ORM\Column]
    private ?int $entries = null;

    /**
     * @var Collection<int, Articles>
     */
    #[ORM\OneToMany(targetEntity: Articles::class, mappedBy: 'typesSport', orphanRemoval: true)]
    private Collection $articles;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $titleImage = null;

    public function __construct()
    {
        $this->sections = new ArrayCollection();
        $this->entries = 0;
        $this->articles = new ArrayCollection();
    }

    public function __toString(): string
    {
        return $this->sportName;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSportName(): ?string
    {
        return $this->sportName;
    }

    public function setSportName(string $sportName): static
    {
        $this->sportName = $sportName;

        return $this;
    }

    /**
     * @return Collection<int, Sections>
     */
    public function getSections(): Collection
    {
        return $this->sections;
    }

    public function addSection(Sections $section): static
    {
        if (!$this->sections->contains($section)) {
            $this->sections->add($section);
            $section->setTypesSport($this);
        }

        return $this;
    }

    public function removeSection(Sections $section): static
    {
        if ($this->sections->removeElement($section)) {
            // set the owning side to null (unless already changed)
            if ($section->getTypesSport() === $this) {
                $section->setTypesSport(null);
            }
        }

        return $this;
    }

    public function getEntries(): ?int
    {
        return $this->entries;
    }

    public function setEntries(int $entries): static
    {
        $this->entries = $entries;

        return $this;
    }

    /**
     * @return Collection<int, Articles>
     */
    public function getArticles(): Collection
    {
        return $this->articles;
    }

    public function addArticle(Articles $article): static
    {
        if (!$this->articles->contains($article)) {
            $this->articles->add($article);
            $article->setTypesSport($this);
        }

        return $this;
    }

    public function removeArticle(Articles $article): static
    {
        if ($this->articles->removeElement($article)) {
            // set the owning side to null (unless already changed)
            if ($article->getTypesSport() === $this) {
                $article->setTypesSport(null);
            }
        }

        return $this;
    }

    public function getTitleImage(): ?string
    {
        return $this->titleImage;
    }

    public function setTitleImage(string $titleImage): static
    {
        $this->titleImage = $titleImage;

        return $this;
    }
}
