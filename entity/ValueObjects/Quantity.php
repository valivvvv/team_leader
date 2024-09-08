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
}
