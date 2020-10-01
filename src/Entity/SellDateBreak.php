<?php

namespace App\Entity;

use App\Repository\SellDateBreaksRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SellDateBreaksRepository::class)
 */
class SellDateBreak
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $start;

    /**
     * @ORM\Column(type="datetime")
     */
    private $end;

    /**
     * @ORM\Column(type="boolean")
     */
    private $mon;

    /**
     * @ORM\Column(type="boolean")
     */
    private $tue;

    /**
     * @ORM\Column(type="boolean")
     */
    private $wed;

    /**
     * @ORM\Column(type="boolean")
     */
    private $thu;

    /**
     * @ORM\Column(type="boolean")
     */
    private $fri;

    /**
     * @ORM\Column(type="boolean")
     */
    private $sat;

    /**
     * @ORM\Column(type="boolean")
     */
    private $sun;

    /**
    * @var \App\Entity\Tour
    *
    * @ORM\ManyToOne(targetEntity="App\Entity\Tour", inversedBy="selldatebreaks")
    * @ORM\JoinColumns({
    *   @ORM\JoinColumn(name="tour", referencedColumnName="id")
    * })
    */
    private $tour;

    /**
      * @var \Doctrine\Common\Collections\Collection
      *
      * @ORM\OneToMany(targetEntity="App\Entity\SellAmount", mappedBy="selldatebreak", cascade={"persist","remove"})
      */

    private $sellamounts;

    public function __construct()
    {
        $this->sellamounts = new ArrayCollection();
        $this->mon = true;
        $this->tue = true;
        $this->wed = true;
        $this->thu = true;
        $this->fri = true;
        $this->sat = true;
        $this->sun = true;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStart(): ?\DateTimeInterface
    {
        return $this->start;
    }

    public function setStart(\DateTimeInterface $start): self
    {
        $this->start = $start;

        return $this;
    }

    public function getEnd(): ?\DateTimeInterface
    {
        return $this->end;
    }

    public function setEnd(\DateTimeInterface $end): self
    {
        $this->end = $end;

        return $this;
    }

    public function getMon(): ?bool
    {
        return $this->mon;
    }

    public function setMon(bool $mon): self
    {
        $this->mon = $mon;

        return $this;
    }

    public function getTue(): ?bool
    {
        return $this->tue;
    }

    public function setTue(bool $tue): self
    {
        $this->tue = $tue;

        return $this;
    }

    public function getWed(): ?bool
    {
        return $this->wed;
    }

    public function setWed(bool $wed): self
    {
        $this->wed = $wed;

        return $this;
    }

    public function getThu(): ?bool
    {
        return $this->thu;
    }

    public function setThu(bool $thu): self
    {
        $this->thu = $thu;

        return $this;
    }

    public function getFri(): ?bool
    {
        return $this->fri;
    }

    public function setFri(bool $fri): self
    {
        $this->fri = $fri;

        return $this;
    }

    public function getSat(): ?bool
    {
        return $this->sat;
    }

    public function setSat(bool $sat): self
    {
        $this->sat = $sat;

        return $this;
    }

    public function getSun(): ?bool
    {
        return $this->sun;
    }

    public function setSun(bool $sun): self
    {
        $this->sun = $sun;

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
            $sellamount->setSelldatebreak($this);
        }

        return $this;
    }

    public function removeSellamount(SellAmount $sellamount): self
    {
        if ($this->sellamounts->contains($sellamount)) {
            $this->sellamounts->removeElement($sellamount);
            // set the owning side to null (unless already changed)
            if ($sellamount->getSelldatebreak() === $this) {
                $sellamount->setSelldatebreak(null);
            }
        }

        return $this;
    }
}
