<?php

namespace entity;

class OrderItem {
    public string $productId;
    public string $quantity;
    public string $unitPrice;
    public string $total;

    public function __construct(string $productId, string $quantity, string $unitPrice, string $total) {
        $this->productId = $productId;
        $this->quantity = $quantity;
        $this->unitPrice = $unitPrice;
        $this->total = $total;
    }

}
