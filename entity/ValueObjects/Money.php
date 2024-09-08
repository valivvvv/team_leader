<?php

declare(strict_types=1);

namespace entity\ValueObjects;

class Money
{
    public function __construct(private readonly float $amount) {}

    public static function make(float $amount): Money
    {
        return new self($amount);
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function applyDiscountPercent(int $discountPercent): Money
    {
        return self::make($this->amount * (1 - $discountPercent / 100));
    }

    public function getDiscountPercentValue(int $discountPercent): Money
    {
        return self::make($this->amount * ($discountPercent / 100));
    }

    public function applyDiscountValue(Money $discountValue): Money
    {
        return self::make($this->getAmount() - $discountValue->getAmount());
    }

    public function isCheaperThan(Money $money): bool
    {
        return $this->amount < $money->getAmount();
    }

    public function isCheaperOrEqualThan(Money $money): bool
    {
        return $this->amount <= $money->getAmount();
    }
}
