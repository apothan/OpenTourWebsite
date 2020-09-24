<?php

namespace App\Entity;

use App\Repository\SellAmountRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SellAmountRepository::class)
 */
class SellAmount
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     */
    private $amount;

    /**
    * @var \App\Entity\SellDateBreak
    *
    * @ORM\ManyToOne(targetEntity="App\Entity\SellDateBreak", inversedBy="sellamounts")
    * @ORM\JoinColumns({
    *   @ORM\JoinColumn(name="selldatebreak", referencedColumnName="id")
    * })
    */
    private $selldatebreak;

    /**
    * @var \App\Entity\TourCategory
    *
    * @ORM\ManyToOne(targetEntity="App\Entity\TourCategory", inversedBy="sellamounts")
    * @ORM\JoinColumns({
    *   @ORM\JoinColumn(name="tourcategory", referencedColumnName="id")
    * })
    */
    private $tourcategory;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAmount(): ?float
    {
        return $this->amount;
    }

    public function setAmount(float $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    public function getSelldatebreak(): ?SellDateBreak
    {
        return $this->selldatebreak;
    }

    public function setSelldatebreak(?SellDateBreak $selldatebreak): self
    {
        $this->selldatebreak = $selldatebreak;

        return $this;
    }

    public function getTourcategory(): ?TourCategory
    {
        return $this->tourcategory;
    }

    public function setTourcategory(?TourCategory $tourcategory): self
    {
        $this->tourcategory = $tourcategory;

        return $this;
    }

    
}
