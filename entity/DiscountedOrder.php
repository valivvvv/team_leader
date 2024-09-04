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
        $this->discountedTotal = $order->total;
        $this->discountMessages = [];
    }

    public function getOrder(): Order
    {
        return $this->order;
    }

    public function applyDiscount(int $discountPercent, string $discountMessage): DiscountedOrder
    {
        $discountedOrder = new DiscountedOrder($this->order);

        $discountedOrder->isDiscounted = true;
        $discountedOrder->discountedTotal = $this->discountedTotal * (1 - $discountPercent / 100);
        $discountedOrder->discountMessages = [...$this->discountMessages, $discountMessage];

        return $discountedOrder;
    }
}
