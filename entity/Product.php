<?php

class Product {
    public int $id;
    public string $description;
    public int $category;
    public float $price;

    public function __construct(int $id, string $description, int $category, float $price) {
        $this->id = $id;
        $this->description = $description;
        $this->category = $category;
        $this->price = $price;
    }

}
