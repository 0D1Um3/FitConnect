<?php

namespace App\Entity;

use App\Repository\ReviewsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReviewsRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Reviews
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $positive = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $negative = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $textReview = null;

    #[ORM\ManyToOne(inversedBy: 'reviews')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Sections $sections = null;

    #[ORM\Column]
    private ?int $rating = null;

    #[ORM\ManyToOne(inversedBy: 'reviews')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $users = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    #[ORm\PrePersist]
    public function setCreatedAtValue()
    {
        $this->createdAt = new \DateTimeImmutable();
    }

    public function getPositive(): ?string
    {
        return $this->positive;
    }

    public function setPositive(?string $positive): static
    {
        $this->positive = $positive;

        return $this;
    }

    public function getNegative(): ?string
    {
        return $this->negative;
    }

    public function setNegative(?string $negative): static
    {
        $this->negative = $negative;

        return $this;
    }

    public function getTextReview(): ?string
    {
        return $this->textReview;
    }

    public function setTextReview(?string $textReview): static
    {
        $this->textReview = $textReview;

        return $this;
    }

    public function getSections(): ?Sections
    {
        return $this->sections;
    }

    public function setSections(?Sections $sections): static
    {
        $this->sections = $sections;

        return $this;
    }

    public function getRating(): ?int
    {
        return $this->rating;
    }

    public function setRating(int $rating): static
    {
        $this->rating = $rating;

        return $this;
    }

    public function getUsers(): ?User
    {
        return $this->users;
    }

    public function setUsers(?User $users): static
    {
        $this->users = $users;

        return $this;
    }
}
