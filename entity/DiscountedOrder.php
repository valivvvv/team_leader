<?php

namespace entity;

class DiscountedOrder
{
    public Order $order;
    public bool $isDiscounted;
    public string $discountedTotal;
    public array $discountMessages;

    public function __construct(Order $order)
    {
        $this->order = $order;
        $this->isDiscounted = false;
        $this->discountedTotal = $order->total;
        $this->discountMessages = [];
    }

    public function applyDiscount(string $discountedTotal, string $discountMessage): void
    {
        $this->isDiscounted = true;
        $this->discountedTotal = $discountedTotal;
        $this->discountMessages[] = $discountMessage;
    }
}
