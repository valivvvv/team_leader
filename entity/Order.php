<?php

namespace entity;

class Order
{
    public string $id;
    public string $customerId;
    public array $items;
    public string $total;

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
}
