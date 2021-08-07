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
use App\Controller\PostCountController;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\BooleanFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;




/**
 * @ApiResource(
 *     collectionOperations={
 *     "get",
 *     "post"={"normalization_context"={"groups"={"write:post_infos"}} ,
 *             "security"="is_granted('ROLE_USER')", }},
 *
 *     normalizationContext={"groups"={"read:post_infos"}},
 *     itemOperations={
 *     "get"={"normalization_context"={"groups"={"read:post_infos"}}},
 *     "patch"={"security"="is_granted('ROLE_ADMIN') or object.garage.professional == user"},
 *     "delete"={"security"="is_granted('ROLE_ADMIN') or object.garage.professional == user"},
 *     })
 *
 * @ApiFilter(SearchFilter::class,
 *     properties={
 *     "model.brand.name"="Renault",
 *      "model.name"="Laguna III"})
 *
 * @apiFilter(RangeFilter::class, properties={"price", "year"})
 * @apiFilter(OrderFilter::class, properties={"datepost"={"ASC"}})
 * @ORM\Entity(repositoryClass=PostRepository::class)
 */

class Post
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\NotBlank(message="Le champ ne peux pas avoir que des caractère vide")
     * @Assert\NotNull(message="Vous devez au moin rentrer une valeur")
     * @Groups("read:post_infos , write:post_infos")
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $price;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\GreaterThan(50)
     */
    private $description;

    /**
     * @Assert\NotBlank(message="Le champ ne peux pas avoir que des caractère vide")
     * @Assert\NotNull(message="Vous devez au moin rentrer une valeur")
     * @Groups("read:post_infos , write:post_infos")
     * @ORM\Column(type="integer")
     */
    private $year;

    /**
     *
     * @ApiFilter(BooleanFilter::class, properties={"year"})
     * @Groups("read:post_infos , write:post_infos")
     * @ORM\Column(type="boolean")
     */
    private $ismanual;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $reference;

    /**
     * @Groups("read:post_infos , write:post_infos")
     * @ORM\Column(type="date")
     */
    private $datepost;

    /**
     * @Assert\NotBlank(message="Le champ ne peux pas avoir que des caractère vide")
     * @Assert\NotNull(message="Vous devez au moin rentrer une valeur")
     * @Groups("read:post_infos , write:post_infos")
     * @ORM\Column(type="integer")
     */
    private $mileage;

    /**
     * @ORM\ManyToOne(targetEntity=Garage::class, inversedBy="Garages")
     */
    public $garage;

    /**
     * @Assert\NotBlank(message="Le champ ne peux pas avoir que des caractère vide")
     * @Assert\NotNull(message="Vous devez au moin rentrer une valeur")
     * @Groups("read:post_infos , write:post_infos")
     * @ORM\ManyToOne(targetEntity=Model::class, inversedBy="models")
     */
    private $model;

    /**
     *
     * @Groups("read:post_infos , write:post_infos")
     * @ORM\OneToMany(targetEntity=Picture::class, mappedBy="pictures")
     */
    private $pictures;

    /**
     * @Assert\NotBlank(message="Le champ ne peux pas avoir que des caractère vide")
     * @Assert\NotNull(message="Vous devez au moin rentrer une valeur")
     * @Groups("read:post_infos , write:post_infos")
     * @ORM\ManyToOne(targetEntity=Fuel::class, inversedBy="fuels")
     */
    private $fuel;

    /**
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
