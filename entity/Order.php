<?php

namespace entity;

class Order
{
    private string $id;
    private string $customerId;
    private array $items;
    private string $total;

    public function __construct(string $id, string $customerId, array $items, string $total)
    {
        $this->id = $id;
        $this->customerId = $customerId;
        $this->items = array_map(static function (array $item) {
            return new OrderItem(
                $item['product-id'],
                $item['quantity'],
                $item['unit-price'],
                $item['total']
            );
        }, $items);
        $this->total = $total;
    }

    public function getTotal(): string
    {
        return $this->total;
    }

    public function getCustomerId(): string
    {
        return $this->customerId;
    }
}
