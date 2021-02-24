<?php

namespace Apothan\OpenToursBundle\Entity;

use Apothan\OpenToursBundle\Repository\TourItineraryRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TourItineraryRepository::class)
 */
class TourItinerary
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $header;

    /**
     * @ORM\Column(type="string", length=1048)
     */
    private $description;

    /**
    * @var \Apothan\OpenToursBundle\Entity\Tour
    *
    * @ORM\ManyToOne(targetEntity="Apothan\OpenToursBundle\Entity\Tour", inversedBy="itinerary")
    * @ORM\JoinColumns({
    *   @ORM\JoinColumn(name="tour", referencedColumnName="id")
    * })
    */
    private $tour;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHeader(): ?string
    {
        return $this->header;
    }

    public function setHeader(string $header): self
    {
        $this->header = $header;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

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
}
