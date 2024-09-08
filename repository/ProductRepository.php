<?php

namespace repository;

use entity\Product;

class ProductRepository
{
    public static function findById(string $id): Product
    {
        $json = file_get_contents(__DIR__ . '/../data/products.json');
        $products = json_decode($json, true);

        $foundProduct = null;

        foreach ($products as $product) {
            if ($product['id'] === $id) {
                $foundProduct = $product;
                break;
            }
        }

        // TODO: handle not found product

        return new Product(
            $foundProduct['id'],
            $foundProduct['description'],
            $foundProduct['category'],
            $foundProduct['price']
        );
    }
}
