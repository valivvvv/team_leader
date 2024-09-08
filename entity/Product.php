<?php

namespace entity;

use entity\ValueObjects\Money;

class Product {
    private string $id;
    private string $description;
    private string $category;
    private Money $price;

    public function __construct(string $id, string $description, string $category, string $price) {
        $this->id = $id;
        $this->description = $description;
        $this->category = $category;
        $this->price = Money::make($price);
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getCategory(): string
    {
        return $this->category;
    }
}
