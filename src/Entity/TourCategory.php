<?php

namespace App\Entity;

use App\Repository\TourCategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TourCategoryRepository::class)
 */
class TourCategory
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $code;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="integer")
     */
    private $min;

    /**
     * @ORM\Column(type="integer")
     */
    private $max;

    /**
     * @ORM\Column(type="string", length=2)
     */
    private $pricing;

    /**
    * @var \App\Entity\Tour
    *
    * @ORM\ManyToOne(targetEntity="App\Entity\Tour", inversedBy="categories")
    * @ORM\JoinColumns({
    *   @ORM\JoinColumn(name="tour", referencedColumnName="id")
    * })
    */
    private $tour;

    /**
      * @var \Doctrine\Common\Collections\Collection
      *
      * @ORM\OneToMany(targetEntity="App\Entity\SellAmount", mappedBy="tourcategory")
      */

      private $sellamounts;

      public function __construct()
      {
          $this->sellamounts = new ArrayCollection();
      }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

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

    public function getMin(): ?int
    {
        return $this->min;
    }

    public function setMin(int $min): self
    {
        $this->min = $min;

        return $this;
    }

    public function getMax(): ?int
    {
        return $this->max;
    }

    public function setMax(int $max): self
    {
        $this->max = $max;

        return $this;
    }

    public function getPricing(): ?string
    {
        return $this->pricing;
    }

    public function setPricing(string $pricing): self
    {
        $this->pricing = $pricing;

        return $this;
    }

    public function getTour(): ?Tour
    {
        return $this->tour;
    }

    public function setTour(?Tour $tour): self
    {
        $this->tour = $tour;

        return $this;
    }

    /**
     * @return Collection|SellAmount[]
     */
    public function getSellamounts(): Collection
    {
        return $this->sellamounts;
    }

    public function addSellamount(SellAmount $sellamount): self
    {
        if (!$this->sellamounts->contains($sellamount)) {
            $this->sellamounts[] = $sellamount;
            $sellamount->setTourcategory($this);
        }

        return $this;
    }

    public function removeSellamount(SellAmount $sellamount): self
    {
        if ($this->sellamounts->contains($sellamount)) {
            $this->sellamounts->removeElement($sellamount);
            // set the owning side to null (unless already changed)
            if ($sellamount->getTourcategory() === $this) {
                $sellamount->setTourcategory(null);
            }
        }

        return $this;
    }
}
