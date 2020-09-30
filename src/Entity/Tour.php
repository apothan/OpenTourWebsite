<?php

namespace App\Entity;

use App\Repository\TourRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TourRepository::class)
 */
class Tour
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
    private $name;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
      * @var \Doctrine\Common\Collections\Collection
      *
      * @ORM\OneToMany(targetEntity="App\Entity\TourCategory", mappedBy="tour", cascade={"persist","remove"})
      */

    private $categories;

    /**
      * @var \Doctrine\Common\Collections\Collection
      *
      * @ORM\OneToMany(targetEntity="App\Entity\SellDateBreak", mappedBy="tour", cascade={"persist","remove"})
      */

    private $selldatebreaks;

    /**
      * @var \Doctrine\Common\Collections\Collection
      *
      * @ORM\OneToMany(targetEntity="App\Entity\TourItinerary", mappedBy="tour", cascade={"persist","remove"})
      */

    private $itinerary;

    /**
      * @var \Doctrine\Common\Collections\Collection
      *
      * @ORM\OneToMany(targetEntity="App\Entity\TourFeature", mappedBy="tour", cascade={"persist","remove"})
      */

      private $features;

    public function __construct()
    {
        $this->categories = new ArrayCollection();
        $this->selldatebreaks = new ArrayCollection();
        $this->itinerary = new ArrayCollection();
        $this->features = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection|TourCategory[]
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function addCategory(TourCategory $category): self
    {
        if (!$this->categories->contains($category)) {
            $this->categories[] = $category;
            $category->setTour($this);
        }

        return $this;
    }

    public function removeCategory(TourCategory $category): self
    {
        if ($this->categories->contains($category)) {
            $this->categories->removeElement($category);
            // set the owning side to null (unless already changed)
            if ($category->getTour() === $this) {
                $category->setTour(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|SellDateBreak[]
     */
    public function getSelldatebreaks(): Collection
    {
        return $this->selldatebreaks;
    }

    public function addSelldatebreak(SellDateBreak $selldatebreak): self
    {
        if (!$this->selldatebreaks->contains($selldatebreak)) {
            $this->selldatebreaks[] = $selldatebreak;
            $selldatebreak->setTour($this);
        }

        return $this;
    }

    public function removeSelldatebreak(SellDateBreak $selldatebreak): self
    {
        if ($this->selldatebreaks->contains($selldatebreak)) {
            $this->selldatebreaks->removeElement($selldatebreak);
            // set the owning side to null (unless already changed)
            if ($selldatebreak->getTour() === $this) {
                $selldatebreak->setTour(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|TourItinerary[]
     */
    public function getItinerary(): Collection
    {
        return $this->itinerary;
    }

    public function addItinerary(TourItinerary $itinerary): self
    {
        if (!$this->itinerary->contains($itinerary)) {
            $this->itinerary[] = $itinerary;
            $itinerary->setTour($this);
        }

        return $this;
    }

    public function removeItinerary(TourItinerary $itinerary): self
    {
        if ($this->itinerary->contains($itinerary)) {
            $this->itinerary->removeElement($itinerary);
            // set the owning side to null (unless already changed)
            if ($itinerary->getTour() === $this) {
                $itinerary->setTour(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|TourFeature[]
     */
    public function getFeatures(): Collection
    {
        return $this->features;
    }

    public function addFeature(TourFeature $feature): self
    {
        if (!$this->features->contains($feature)) {
            $this->features[] = $feature;
            $feature->setTour($this);
        }

        return $this;
    }

    public function removeFeature(TourFeature $feature): self
    {
        if ($this->features->contains($feature)) {
            $this->features->removeElement($feature);
            // set the owning side to null (unless already changed)
            if ($feature->getTour() === $this) {
                $feature->setTour(null);
            }
        }

        return $this;
    }
}
