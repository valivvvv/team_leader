<?php

declare(strict_types=1);

namespace repository;

use entity\Product;

class ProductRepository
{
    /**
     * @throws \Exception
     */
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

        if ($foundProduct === null) {
            throw new \Exception('Product not found', 404);
        }

        return new Product(
            $foundProduct['id'],
            $foundProduct['description'],
            $foundProduct['category'],
            (float)$foundProduct['price']
        );
    }
}
