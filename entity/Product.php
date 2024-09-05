<?php

namespace entity;

class Product {
    private string $id;
    private string $description;
    private string $category;
    private string $price;

    public function __construct(string $id, string $description, string $category, string $price) {
        $this->id = $id;
        $this->description = $description;
        $this->category = $category;
        $this->price = $price;
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
