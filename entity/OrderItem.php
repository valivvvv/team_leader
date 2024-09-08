<?php

namespace entity;

use entity\ValueObjects\Money;
use entity\ValueObjects\Quantity;

class OrderItem {
    private string $productId;
    private Quantity $quantity;
    private Money $unitPrice;
    private Money $total;

    public function __construct(string $productId, string $quantity, string $unitPrice, string $total) {
        $this->productId = $productId;
        $this->quantity = Quantity::make($quantity);
        $this->unitPrice = Money::make($unitPrice);
        $this->total = Money::make($total);
    }

    public function getProductId(): string
    {
        return $this->productId;
    }

    public function getQuantity(): Quantity
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

    public function addQuantity(Quantity $quantityToAdd): Quantity
    {
        return $this->quantity->add($quantityToAdd);
    }

    public function toArray(): array
    {
        return [
            'product_id' => $this->productId,
            'quantity' => $this->quantity->getQuantity(),
            'unit_price' => $this->unitPrice->getAmount(),
            'total' => $this->total->getAmount()
        ];
    }
}
