<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use App\Repository\BrandRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;


/**
 * @ORM\Entity(repositoryClass=BrandRepository::class)
 */
class Brand
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Groups("read:post_infos")
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     *
     * @ORM\OneToMany(targetEntity=model::class, mappedBy="brand", orphanRemoval=true)
     */
    private $brands;

    public function __construct()
    {
        $this->brands = new ArrayCollection();
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
     * @return Collection|model[]
     */
    public function getBrands(): Collection
    {
        return $this->brands;
    }

    public function addBrand(model $brand): self
    {
        if (!$this->brands->contains($brand)) {
            $this->brands[] = $brand;
            $brand->setBrand($this);
        }

        return $this;
    }

    public function removeBrand(model $brand): self
    {
        if ($this->brands->removeElement($brand)) {
            // set the owning side to null (unless already changed)
            if ($brand->getBrand() === $this) {
                $brand->setBrand(null);
            }
        }

        return $this;
    }
}
