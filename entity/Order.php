<?php

namespace entity;

use entity\ValueObjects\Money;

class Order
{
    private string $id;
    private string $customerId;
    private array $items;
    private Money $total;

    public function __construct(string $id, string $customerId, array $items, Money $total)
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

        return new self($id, $customerId, $orderItems, Money::make($total));
    }

    public function getCustomerId(): string
    {
        return $this->customerId;
    }

    public function getItems(): array
    {
        return $this->items;
    }

    public function getTotal(): Money
    {
        return $this->total;
    }

    public function addItemQuantity(string $productId, int $quantityToAdd): Order
    {
        $items = array_map(static function (OrderItem $item) use ($productId, $quantityToAdd) {
            $quantity = $item->getProductId() === $productId
                ? $item->getQuantity() + $quantityToAdd
                :$item->getQuantity();

            return [
                'product-id' => $item->getProductId(),
                'quantity' => $quantity,
                'unit-price' => $item->getUnitPrice()->getAmount(),
                'total' => $item->getTotal()->getAmount()
            ];
        }, $this->items);

        return self::fromArray(
            $this->id,
            $this->customerId,
            $items,
            $this->total->getAmount()
        );
    }
}
