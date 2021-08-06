<?php

namespace App\Entity;

use App\Repository\CarcategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * @ORM\Entity(repositoryClass=CarcategoryRepository::class)
 */
class Carcategory
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
     * @ORM\OneToMany(targetEntity=post::class, mappedBy="carcategory")
     */
    private $carcategories;

    public function __construct()
    {
        $this->carcategories = new ArrayCollection();
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
    public function getCarcategories(): Collection
    {
        return $this->carcategories;
    }

    public function addCarcategory(post $carcategory): self
    {
        if (!$this->carcategories->contains($carcategory)) {
            $this->carcategories[] = $carcategory;
            $carcategory->setCarcategory($this);
        }

        return $this;
    }

    public function removeCarcategory(post $carcategory): self
    {
        if ($this->carcategories->removeElement($carcategory)) {
            // set the owning side to null (unless already changed)
            if ($carcategory->getCarcategory() === $this) {
                $carcategory->setCarcategory(null);
            }
        }

        return $this;
    }
}
