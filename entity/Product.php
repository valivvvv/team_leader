<?php

namespace entity;

class Product {
    public string $id;
    public string $description;
    public string $category;
    public string $price;

    public function __construct(string $id, string $description, string $category, string $price) {
        $this->id = $id;
        $this->description = $description;
        $this->category = $category;
        $this->price = $price;
    }

}
