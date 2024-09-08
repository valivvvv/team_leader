<?php

declare(strict_types=1);

namespace entity;

use entity\ValueObjects\Money;

class Customer {

    public function __construct(
        private readonly string $id,
        private readonly string $name,
        private readonly string $since,
        private readonly Money $revenue
    ) {}

    public static function make(
        string $id,
        string $name,
        string $since,
        float $revenue
    ): Customer {
        return new self($id, $name, $since, Money::make($revenue));
    }

    public function getRevenue(): Money
    {
        return $this->revenue;
    }
}
