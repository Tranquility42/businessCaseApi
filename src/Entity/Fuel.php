<?php

namespace App\Entity;

use App\Repository\FuelRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * @ApiResource(itemOperations={"get"})
 * @ORM\Entity(repositoryClass=FuelRepository::class)
 */
class Fuel
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
     * @ORM\OneToMany(targetEntity=post::class, mappedBy="fuel")
     */
    private $fuels;

    public function __construct()
    {
        $this->fuels = new ArrayCollection();
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
    public function getFuels(): Collection
    {
        return $this->fuels;
    }

    public function addFuel(post $fuel): self
    {
        if (!$this->fuels->contains($fuel)) {
            $this->fuels[] = $fuel;
            $fuel->setFuel($this);
        }

        return $this;
    }

    public function removeFuel(post $fuel): self
    {
        if ($this->fuels->removeElement($fuel)) {
            // set the owning side to null (unless already changed)
            if ($fuel->getFuel() === $this) {
                $fuel->setFuel(null);
            }
        }

        return $this;
    }
}
