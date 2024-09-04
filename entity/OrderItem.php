<?php

namespace entity;

class OrderItem {
    private string $productId;
    private string $quantity;
    private string $unitPrice;
    private string $total;

    public function __construct(string $productId, string $quantity, string $unitPrice, string $total) {
        $this->productId = $productId;
        $this->quantity = $quantity;
        $this->unitPrice = $unitPrice;
        $this->total = $total;
    }

}
