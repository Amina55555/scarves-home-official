<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\OrdersRepository")
 */
class Orders
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
    private $total_price_ht;

    /**
     * @ORM\Column(type="float")
     */
    private $tva;

    /**
     * @ORM\Column(type="float")
     */
    private $vat_rate;

    /**
     * @ORM\Column(type="integer")
     */
    private $order_number;

    /**
     * @ORM\Column(type="boolean")
     */
    private $is_paid;

    /**
     * @ORM\Column(type="date")
     */
    private $delivery_date;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $billing_address;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Users", inversedBy="Orders")
     */
    private $users;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Address", inversedBy="orders")
     */
    private $Address;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\LignesOrders", mappedBy="orders")
     */
    private $Lignes_Orders;

    public function __construct()
    {
        $this->Lignes_Orders = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTotalPriceHt(): ?float
    {
        return $this->total_price_ht;
    }

    public function setTotalPriceHt(float $total_price_ht): self
    {
        $this->total_price_ht = $total_price_ht;

        return $this;
    }

    public function getTva(): ?float
    {
        return $this->tva;
    }

    public function setTva(float $tva): self
    {
        $this->tva = $tva;

        return $this;
    }

    public function getVatRate(): ?float
    {
        return $this->vat_rate;
    }

    public function setVatRate(float $vat_rate): self
    {
        $this->vat_rate = $vat_rate;

        return $this;
    }

    public function getOrderNumber(): ?int
    {
        return $this->order_number;
    }

    public function setOrderNumber(int $order_number): self
    {
        $this->order_number = $order_number;

        return $this;
    }

    public function getIsPaid(): ?bool
    {
        return $this->is_paid;
    }

    public function setIsPaid(bool $is_paid): self
    {
        $this->is_paid = $is_paid;

        return $this;
    }

    public function getDeliveryDate(): ?\DateTimeInterface
    {
        return $this->delivery_date;
    }

    public function setDeliveryDate(\DateTimeInterface $delivery_date): self
    {
        $this->delivery_date = $delivery_date;

        return $this;
    }

    public function getBillingAddress(): ?string
    {
        return $this->billing_address;
    }

    public function setBillingAddress(string $billing_address): self
    {
        $this->billing_address = $billing_address;

        return $this;
    }

    public function getUsers(): ?Users
    {
        return $this->users;
    }

    public function setUsers(?Users $users): self
    {
        $this->users = $users;

        return $this;
    }

    public function getAddress(): ?Address
    {
        return $this->Address;
    }

    public function setAddress(?Address $Address): self
    {
        $this->Address = $Address;

        return $this;
    }

    /**
     * @return Collection|LignesOrders[]
     */
    public function getLignesOrders(): Collection
    {
        return $this->Lignes_Orders;
    }

    public function addLignesOrder(LignesOrders $lignesOrder): self
    {
        if (!$this->Lignes_Orders->contains($lignesOrder)) {
            $this->Lignes_Orders[] = $lignesOrder;
            $lignesOrder->setOrders($this);
        }

        return $this;
    }

    public function removeLignesOrder(LignesOrders $lignesOrder): self
    {
        if ($this->Lignes_Orders->contains($lignesOrder)) {
            $this->Lignes_Orders->removeElement($lignesOrder);
            // set the owning side to null (unless already changed)
            if ($lignesOrder->getOrders() === $this) {
                $lignesOrder->setOrders(null);
            }
        }

        return $this;
    }
    public function __toString()
    {
        return $this->lastName;
    }
}
