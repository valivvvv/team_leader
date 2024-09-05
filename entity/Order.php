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
        $this->items = $items;
        $this->total = $total;
    }

    public static function fromArray(string $id, string $customerId, array $items, float $total): self
    {
        $orderItems = array_map(static function (array $item) {
            return new OrderItem(
                $item['product-id'],
                $item['quantity'],
                $item['unit-price'],
                $item['total']
            );
        }, $items);

        return new self($id, $customerId, $orderItems, $total);
    }

    public function getCustomerId(): string
    {
        return $this->customerId;
    }

    public function getItems(): array
    {
        return $this->items;
    }

    public function getTotal(): string
    {
        return $this->total;
    }

    public function addItemQuantity(string $productId, int $quantityToAdd): Order
    {
        return self::fromArray(
            $this->id,
            $this->customerId,
            array_map(static function (OrderItem $item) use ($productId, $quantityToAdd) {
                $quantity = $item->getProductId() === $productId
                    ? $item->getQuantity() + $quantityToAdd
                    :$item->getQuantity();

                return [
                    'product-id' => $item->getProductId(),
                    'quantity' => $quantity,
                    'unit-price' => $item->getUnitPrice(),
                    'total' => $item->getTotal()
                ];
            }, $this->items),
            $this->total
        );
    }
}
