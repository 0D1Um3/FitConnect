<?php

namespace App\Entity;

use App\Repository\SectionsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SectionsRepository::class)]
class Sections
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(nullable: true)]
    private ?int $price = null;

    #[ORM\Column]
    private ?bool $itFree = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column(length: 20)]
    private ?string $contactPhone = null;

    #[ORM\Column(length: 255)]
    private ?string $contactEmail = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $forWho = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $format = null;

    /**
     * @var Collection<int, Reviews>
     */
    #[ORM\OneToMany(targetEntity: Reviews::class, mappedBy: 'sections', orphanRemoval: true)]
    private Collection $reviews;

    #[ORM\ManyToOne(inversedBy: 'sections')]
    #[ORM\JoinColumn(nullable: false)]
    private ?City $cities = null;

    #[ORM\ManyToOne(inversedBy: 'sections')]
    #[ORM\JoinColumn(nullable: false)]
    private ?TypeSport $typesSport = null;

    #[ORM\Column]
    private ?int $countPlaces = null;

    #[ORM\Column]
    private ?bool $softDelete = null;

    #[ORM\Column(length: 255)]
    private ?string $address = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $linkToMap = null;


    /**
     * @var Collection<int, UserEntries>
     */
    #[ORM\OneToMany(targetEntity: UserEntries::class, mappedBy: 'sections', orphanRemoval: true)]
    private Collection $userEntries;

    /**
     * @var Collection<int, CompareSection>
     */
    #[ORM\OneToMany(targetEntity: CompareSection::class, mappedBy: 'sections', orphanRemoval: true)]
    private Collection $compareSections;

    public function __construct()
    {
        $this->reviews = new ArrayCollection();
        $this->userEntries = new ArrayCollection();
        $this->compareSections = new ArrayCollection();
    }

    public function __toString(): string
    {
        return $this->name;
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

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(?int $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function isItFree(): ?bool
    {
        return $this->itFree;
    }

    public function setItFree(bool $itFree): static
    {
        $this->itFree = $itFree;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getContactPhone(): ?string
    {
        return $this->contactPhone;
    }

    public function setContactPhone(string $contactPhone): static
    {
        $this->contactPhone = $contactPhone;

        return $this;
    }

    public function getContactEmail(): ?string
    {
        return $this->contactEmail;
    }

    public function setContactEmail(string $contactEmail): static
    {
        $this->contactEmail = $contactEmail;

        return $this;
    }

    public function getForWho(): ?string
    {
        return $this->forWho;
    }

    public function setForWho(string $forWho): static
    {
        $this->forWho = $forWho;

        return $this;
    }

    public function getFormat(): ?string
    {
        return $this->format;
    }

    public function setFormat(string $format): static
    {
        $this->format = $format;

        return $this;
    }

    /**
     * @return Collection<int, Reviews>
     */
    public function getReviews(): Collection
    {
        return $this->reviews;
    }

    public function addReview(Reviews $review): static
    {
        if (!$this->reviews->contains($review)) {
            $this->reviews->add($review);
            $review->setSections($this);
        }

        return $this;
    }

    public function removeReview(Reviews $review): static
    {
        if ($this->reviews->removeElement($review)) {
            // set the owning side to null (unless already changed)
            if ($review->getSections() === $this) {
                $review->setSections(null);
            }
        }

        return $this;
    }

    public function getCities(): ?City
    {
        return $this->cities;
    }

    public function setCities(?City $cities): static
    {
        $this->cities = $cities;

        return $this;
    }

    public function getTypesSport(): ?TypeSport
    {
        return $this->typesSport;
    }

    public function setTypesSport(?TypeSport $typesSport): static
    {
        $this->typesSport = $typesSport;

        return $this;
    }

    public function getCountPlaces(): ?int
    {
        return $this->countPlaces;
    }

    public function setCountPlaces(int $countPlaces): static
    {
        $this->countPlaces = $countPlaces;

        return $this;
    }

    public function isSoftDelete(): ?bool
    {
        return $this->softDelete;
    }

    public function setSoftDelete(bool $softDelete): static
    {
        $this->softDelete = $softDelete;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): static
    {
        $this->address = $address;

        return $this;
    }

    public function getLinkToMap(): ?string
    {
        return $this->linkToMap;
    }

    public function setLinkToMap(string $linkToMap): static
    {
        $this->linkToMap = $linkToMap;

        return $this;
    }


    /**
     * @return Collection<int, UserEntries>
     */
    public function getUserEntries(): Collection
    {
        return $this->userEntries;
    }

    public function addUserEntry(UserEntries $userEntry): static
    {
        if (!$this->userEntries->contains($userEntry)) {
            $this->userEntries->add($userEntry);
            $userEntry->setSections($this);
        }

        return $this;
    }

    public function removeUserEntry(UserEntries $userEntry): static
    {
        if ($this->userEntries->removeElement($userEntry)) {
            // set the owning side to null (unless already changed)
            if ($userEntry->getSections() === $this) {
                $userEntry->setSections(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, CompareSection>
     */
    public function getCompareSections(): Collection
    {
        return $this->compareSections;
    }

    public function addCompareSection(CompareSection $compareSection): static
    {
        if (!$this->compareSections->contains($compareSection)) {
            $this->compareSections->add($compareSection);
            $compareSection->setSections($this);
        }

        return $this;
    }

    public function removeCompareSection(CompareSection $compareSection): static
    {
        if ($this->compareSections->removeElement($compareSection)) {
            // set the owning side to null (unless already changed)
            if ($compareSection->getSections() === $this) {
                $compareSection->setSections(null);
            }
        }

        return $this;
    }
}
