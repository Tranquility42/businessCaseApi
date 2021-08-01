<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\PostRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\RangeFilter;
use ApiPlatform\Core\Bridge\Elasticsearch\DataProvider\Filter\OrderFilter;

/**
 * @ApiResource(
 *     normalizationContext={"groupe"={"read:post_infos"}},
 *     denormalizationContext={"groupe"={"write:post_infos"},"groupe"={"update:post_infos"}},
 *     collectionOperations={"get","post"={"validation_groups"={"write:post_infos"},{"update:post_infos"}}},
 *     itemOperations={
 *          "get"={"normalization_context"={"groups"={"read:post_infos"}}},
 *          "delete",
 *          "put"}
 * )
 * @ORM\Entity(repositoryClass=PostRepository::class)
 */

class Post
{
    /**
     * @ORM\Id
     * @Groups("read:post_infos")
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ApiFilter(RangeFilter::class, properties={"price"})
     * @Assert\Length(min=3)
     * @Groups("update:post_infos")
     * @Groups("read:post_infos")
     * @Groups("write:post_infos")
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $price;

    /**
     * @Assert\Length(min=25)
     * @Groups("update:post_infos")
     * @Groups("read:post_infos")
     * @Groups("write:post_infos")
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ApiFilter(RangeFilter::class, properties={"year"})
     * @Assert\Length(min=4)
     * @Groups("update:post_infos")
     * @Groups("read:post_infos")
     * @Groups("write:post_infos")
     * @ORM\Column(type="integer")
     */
    private $year;

    /**
     * @Groups("update:post_infos")
     * @Groups("read:post_infos")
     * @Groups("write:post_infos")
     * @ORM\Column(type="boolean")
     */
    private $ismanual;

    /**
     * @Groups("update:post_infos")
     * @Groups("read:post_infos")
     * @Groups("write:post_infos")
     * @ORM\Column(type="string", length=255)
     */
    private $reference;

    /**
     * @ApiFilter (OrderFilter::class , properties={"datepost"="DESC"})
     * @Groups("read:post_infos")
     * @ORM\Column(type="date")
     */
    private $datepost;

    /**

     * @Groups("update:post_infos")
     * @Groups("read:post_infos")
     * @Groups("write:post_infos")
     * @ORM\Column(type="integer")
     */
    private $mileage;

    /**
     * @Groups("read:post_infos")
     * @ORM\ManyToOne(targetEntity=Garage::class, inversedBy="Garages")
     */
    private $garage;

    /**
     * @Groups("update:post_infos")
     * @Groups("read:post_infos")
     * @Groups("write:post_infos")
     * @ORM\ManyToOne(targetEntity=Model::class, inversedBy="models")
     */
    private $model;

    /**
     * @Groups("update:post_infos")
     * @Groups("read:post_infos")
     * @Groups("write:post_infos")
     * @ORM\OneToMany(targetEntity=Picture::class, mappedBy="pictures")
     */
    private $pictures;

    /**
     * @Groups("update:post_infos")
     * @Groups("read:post_infos")
     * @Groups("write:post_infos")
     * @ORM\ManyToOne(targetEntity=Fuel::class, inversedBy="fuels")
     */
    private $fuel;

    /**
     * @Groups("update:post_infos")
     * @Groups("read:post_infos")
     * @Groups("write:post_infos")
     * @ORM\ManyToOne(targetEntity=Carcategory::class, inversedBy="carcategories")
     */
    private $carcategory;

    public function __construct()
    {
        $this->pictures = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(string $price): self
    {
        $this->price = $price;

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

    public function getYear(): ?int
    {
        return $this->year;
    }

    public function setYear(int $year): self
    {
        $this->year = $year;

        return $this;
    }

    public function getIsmanual(): ?bool
    {
        return $this->ismanual;
    }

    public function setIsmanual(bool $ismanual): self
    {
        $this->ismanual = $ismanual;

        return $this;
    }

    public function getReference(): ?string
    {
        return $this->reference;
    }

    public function setReference(string $reference): self
    {
        $this->reference = $reference;

        return $this;
    }

    public function getDatepost(): ?\DateTimeInterface
    {
        return $this->datepost;
    }

    public function setDatepost(\DateTimeInterface $datepost): self
    {
        $this->datepost = $datepost;

        return $this;
    }

    public function getMileage(): ?int
    {
        return $this->mileage;
    }

    public function setMileage(int $mileage): self
    {
        $this->mileage = $mileage;

        return $this;
    }

    public function getGarage(): ?Garage
    {
        return $this->garage;
    }

    public function setGarage(?Garage $garage): self
    {
        $this->garage = $garage;

        return $this;
    }

    public function getModel(): ?Model
    {
        return $this->model;
    }

    public function setModel(?Model $model): self
    {
        $this->model = $model;

        return $this;
    }

    /**
     * @return Collection|Picture[]
     */
    public function getPictures(): Collection
    {
        return $this->pictures;
    }

    public function addPicture(Picture $picture): self
    {
        if (!$this->pictures->contains($picture)) {
            $this->pictures[] = $picture;
            $picture->setPictures($this);
        }

        return $this;
    }

    public function removePicture(Picture $picture): self
    {
        if ($this->pictures->removeElement($picture)) {
            // set the owning side to null (unless already changed)
            if ($picture->getPictures() === $this) {
                $picture->setPictures(null);
            }
        }

        return $this;
    }

    public function getFuel(): ?Fuel
    {
        return $this->fuel;
    }

    public function setFuel(?Fuel $fuel): self
    {
        $this->fuel = $fuel;

        return $this;
    }

    public function getCarcategory(): ?Carcategory
    {
        return $this->carcategory;
    }

    public function setCarcategory(?Carcategory $carcategory): self
    {
        $this->carcategory = $carcategory;

        return $this;
    }
}
