<?php

namespace entity;

use entity\ValueObjects\Money;

class OrderItem {
    private string $productId;
    private string $quantity;
    private Money $unitPrice;
    private Money $total;

    public function __construct(string $productId, string $quantity, string $unitPrice, string $total) {
        $this->productId = $productId;
        $this->quantity = $quantity;
        $this->unitPrice = Money::make($unitPrice);
        $this->total = Money::make($total);
    }

    public function getProductId(): string
    {
        return $this->productId;
    }

    public function getQuantity(): string
    {
        return $this->quantity;
    }

    public function getUnitPrice(): Money
    {
        return $this->unitPrice;
    }

    public function getTotal(): Money
    {
        return $this->total;
    }

}
