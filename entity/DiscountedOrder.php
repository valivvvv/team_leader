<?php

namespace entity;

use entity\ValueObjects\Money;
use entity\ValueObjects\Quantity;

class DiscountedOrder
{
    private Order $order;
    private Money $discountedTotal;
    private array $discountMessages;
    private bool $isDiscounted;

    public function __construct(Order $order,
                                Money $discountedTotal,
                                array $discountMessages = [],
                                bool $isDiscounted = false
    ) {
        $this->order = $order;
        $this->discountedTotal = $discountedTotal;
        $this->discountMessages = $discountMessages;
        $this->isDiscounted = $isDiscounted;
    }

    public static function fromOrder(Order $order): self
    {
        return new self($order,  $order->getTotal());
    }

    public function getOrder(): Order
    {
        return $this->order;
    }

    public function applyDiscountPercent(int $discountPercent, string $discountMessage): DiscountedOrder
    {
        return new DiscountedOrder(
            $this->order,
            $this->discountedTotal->applyDiscountPercent($discountPercent),
            [...$this->discountMessages, $discountMessage],
            true
        );
    }

    public function applyDiscountValue(Money $discountValue, string $discountMessage): DiscountedOrder
    {

        return new DiscountedOrder(
            $this->order,
            $this->discountedTotal->applyDiscountValue($discountValue),
            [...$this->discountMessages, $discountMessage],
            true
        );
    }

    public function addItemQuantity(string $productId, Quantity $quantityToAdd, string $discountMessage): DiscountedOrder
    {
        return new DiscountedOrder(
            $this->order->addItemQuantity($productId, $quantityToAdd),
            $this->discountedTotal,
            [...$this->discountMessages, $discountMessage],
            true
        );
    }

    public function toArray(): array
    {
        return [
            'order' => $this->order->toArray(),
            'discounted_total' => $this->discountedTotal->getAmount(),
            'discount_messages' => $this->discountMessages,
            'is_discounted' => $this->isDiscounted
        ];
    }
}
