<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\AddressRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource(itemOperations={"get","put","delete"},collectionOperations={"get","post"})
 * @ORM\Entity(repositoryClass=AddressRepository::class)
 */
class Address
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
    private $firstline;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $secondline;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $thirdline;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $city;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $zipcode;

    /**
     * @ORM\OneToOne(targetEntity=garage::class, inversedBy="address", cascade={"persist", "remove"})
     */
    private $addresses;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstline(): ?string
    {
        return $this->firstline;
    }

    public function setFirstline(string $firstline): self
    {
        $this->firstline = $firstline;

        return $this;
    }

    public function getSecondline(): ?string
    {
        return $this->secondline;
    }

    public function setSecondline(?string $secondline): self
    {
        $this->secondline = $secondline;

        return $this;
    }

    public function getThirdline(): ?string
    {
        return $this->thirdline;
    }

    public function setThirdline(?string $thirdline): self
    {
        $this->thirdline = $thirdline;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getZipcode(): ?string
    {
        return $this->zipcode;
    }

    public function setZipcode(string $zipcode): self
    {
        $this->zipcode = $zipcode;

        return $this;
    }

    public function getAddresses(): ?garage
    {
        return $this->addresses;
    }

    public function setAddresses(?garage $addresses): self
    {
        $this->addresses = $addresses;

        return $this;
    }
}
