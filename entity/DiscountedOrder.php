<?php

namespace entity;

class DiscountedOrder
{
    private Order $order;
    private bool $isDiscounted;
    private string $discountedTotal;
    private array $discountMessages;

    public function __construct(Order $order)
    {
        $this->order = $order;
        $this->isDiscounted = false;
        $this->discountedTotal = $order->getTotal();
        $this->discountMessages = [];
    }

    public function getOrder(): Order
    {
        return $this->order;
    }

    public function applyDiscount(int $discountPercent, string $discountMessage): DiscountedOrder
    {
        $discountedOrder = new DiscountedOrder($this->order);

        $discountedOrder->discountedTotal = $this->discountedTotal * (1 - $discountPercent / 100);

        $discountedOrder->isDiscounted = true;
        $discountedOrder->discountMessages = [...$this->discountMessages, $discountMessage];

        return $discountedOrder;
    }

    public function addItemQuantity(string $productId, int $quantityToAdd, string $discountMessage): DiscountedOrder
    {
        $order = $this->order->addItemQuantity($productId, $quantityToAdd);

        $discountedOrder = new DiscountedOrder($order);

        $discountedOrder->isDiscounted = true;
        $discountedOrder->discountMessages = [...$this->discountMessages, $discountMessage];

        return $discountedOrder;
    }
}
