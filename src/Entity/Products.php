<?php

namespace App\Entity;
use App\Entity\Products;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProductsRepository")
 */
class Products
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="float")
     */
    private $price_ht;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $picture;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\LignesOrders", mappedBy="Products")
     */
    private $lignesOrders;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Categories", inversedBy="products")
     */
    private $Categories;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Comments", mappedBy="products")
     */
    private $Comments;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Pictures", mappedBy="Products")
     */
    private $pictures;

    public function __construct()
    {
        $this->lignesOrders = new ArrayCollection();
        $this->Comments = new ArrayCollection();
        $this->pictures = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPriceHt(): ?float
    {
        return $this->price_ht;
    }

    public function setPriceHt(float $price_ht): self
    {
        $this->price_ht = $price_ht;

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(string $picture): self
    {
        $this->picture = $picture;

        return $this;
    }

    /**
     * @return Collection|LignesOrders[]
     */
    public function getLignesOrders(): Collection
    {
        return $this->lignesOrders;
    }

    public function addLignesOrder(LignesOrders $lignesOrder): self
    {
        if (!$this->lignesOrders->contains($lignesOrder)) {
            $this->lignesOrders[] = $lignesOrder;
            $lignesOrder->setProducts($this);
        }

        return $this;
    }

    public function removeLignesOrder(LignesOrders $lignesOrder): self
    {
        if ($this->lignesOrders->contains($lignesOrder)) {
            $this->lignesOrders->removeElement($lignesOrder);
            // set the owning side to null (unless already changed)
            if ($lignesOrder->getProducts() === $this) {
                $lignesOrder->setProducts(null);
            }
        }

        return $this;
    }

    public function getCategories(): ?Categories
    {
        return $this->Categories;
    }

    public function setCategories(?Categories $Categories): self
    {
        $this->Categories = $Categories;

        return $this;
    }

    /**
     * @return Collection|Comments[]
     */
    public function getComments(): Collection
    {
        return $this->Comments;
    }

    public function addComment(Comments $comment): self
    {
        if (!$this->Comments->contains($comment)) {
            $this->Comments[] = $comment;
            $comment->setProducts($this);
        }

        return $this;
    }

    public function removeComment(Comments $comment): self
    {
        if ($this->Comments->contains($comment)) {
            $this->Comments->removeElement($comment);
            // set the owning side to null (unless already changed)
            if ($comment->getProducts() === $this) {
                $comment->setProducts(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Pictures[]
     */
    public function getPictures(): Collection
    {
        return $this->pictures;
    }

    public function addPicture(Pictures $picture): self
    {
        if (!$this->pictures->contains($picture)) {
            $this->pictures[] = $picture;
            $picture->setProducts($this);
        }

        return $this;
    }

    public function removePicture(Pictures $picture): self
    {
        if ($this->pictures->contains($picture)) {
            $this->pictures->removeElement($picture);
            // set the owning side to null (unless already changed)
            if ($picture->getProducts() === $this) {
                $picture->setProducts(null);
            }
        }

        return $this;
    }
    public function __toString()
{
    return $this->picture;
}
}
