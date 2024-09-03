<?php

namespace repository;

use entity\Product;

class ProductRepository
{
    public static function findById(string $id): Product
    {
        $json = file_get_contents(__DIR__ . '/../data/products.json');
        $products = json_decode($json, true);

        $product = array_filter($products, static function (array $product) use ($id) {
            return $product['id'] === $id;
        })[0]; // TODO: handle not found

        return new Product(
            $product['id'],
            $product['description'],
            $product['category'],
            $product['price']
        );
    }
}
