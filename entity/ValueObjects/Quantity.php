<?php

namespace entity\ValueObjects;

class Quantity
{
    public function __construct(private readonly int $quantity) {}

    public static function make(int $quantity): Quantity
    {
        return new self($quantity);
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function add(Quantity $quantityToAdd): Quantity
    {
        return new self($this->getQuantity() + $quantityToAdd->getQuantity());
    }

    public function greaterThanOrEqual(int $quantityToCompare): bool
    {
        return $this->quantity >= $quantityToCompare;
    }

    public function isLessThan(int $quantityToCompare): bool
    {
        return $this->quantity < $quantityToCompare;
    }
}
