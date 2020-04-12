<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LignesOrdersRepository")
 */
class LignesOrders
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     */
    private $unit_price_ht;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantity;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Orders", inversedBy="Lignes_Orders")
     */
    private $orders;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Products", inversedBy="lignesOrders")
     */
    private $Products;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUnitPriceHt(): ?float
    {
        return $this->unit_price_ht;
    }

    public function setUnitPriceHt(float $unit_price_ht): self
    {
        $this->unit_price_ht = $unit_price_ht;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getOrders(): ?Orders
    {
        return $this->orders;
    }

    public function setOrders(?Orders $orders): self
    {
        $this->orders = $orders;

        return $this;
    }

    public function getProducts(): ?Products
    {
        return $this->Products;
    }

    public function setProducts(?Products $Products): self
    {
        $this->Products = $Products;

        return $this;
    }
}
