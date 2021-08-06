<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\GarageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GarageRepository::class)
 */
class Garage
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
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=post::class, mappedBy="garage")
     */
    private $garages;

    /**
     * @ORM\OneToOne(targetEntity=Address::class, mappedBy="addresses", cascade={"persist", "remove"})
     */
    private $address;


    public function __construct()
    {
        $this->garages = new ArrayCollection();
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

    /**
     * @return Collection|post[]
     */
    public function getGarages(): Collection
    {
        return $this->garages;
    }

    public function addGarage(post $garage): self
    {
        if (!$this->garages->contains($garage)) {
            $this->garages[] = $garage;
            $garage->setGarage($this);
        }

        return $this;
    }

    public function removeGarage(post $garage): self
    {
        if ($this->garages->removeElement($garage)) {
            // set the owning side to null (unless already changed)
            if ($garage->getGarage() === $this) {
                $garage->setGarage(null);
            }
        }

        return $this;
    }

    public function getAddress(): ?Address
    {
        return $this->address;
    }

    public function setAddress(?Address $address): self
    {
        // unset the owning side of the relation if necessary
        if ($address === null && $this->address !== null) {
            $this->address->setAddresses(null);
        }

        // set the owning side of the relation if necessary
        if ($address !== null && $address->getAddresses() !== $this) {
            $address->setAddresses($this);
        }

        $this->address = $address;

        return $this;
    }

}
