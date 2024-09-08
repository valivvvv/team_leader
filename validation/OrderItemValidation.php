<?php

declare(strict_types=1);

namespace validation;

class OrderItemValidation
{
    /**
     * @throws \Exception
     */
    public static function validate(array $request): array
    {
        if (!isset($request['product-id'])) {
            throw new \Exception('Product ID is required', 400);
        }

        if (!isset($request['quantity'])) {
            throw new \Exception('Quantity is required', 400);
        }

        if (!isset($request['unit-price'])) {
            throw new \Exception('Unit price is required', 400);
        }

        if (!isset($request['total'])) {
            throw new \Exception('Total is required', 400);
        }

        if (!is_string($request['product-id'])) {
            throw new \Exception('Product ID must be a string', 400);
        }

        if (!is_string($request['quantity'])) {
            throw new \Exception('Quantity must be a string', 400);
        }

        if (!(int)$request['quantity']) {
            throw new \Exception('Quantity must be a valid number', 400);
        }

        if (!is_string($request['unit-price'])) {
            throw new \Exception('Unit price must be a string', 400);
        }

        if (!(float)$request['quantity']) {
            throw new \Exception('Unit price must be a valid number', 400);
        }

        if (!is_string($request['total'])) {
            throw new \Exception('Total must be a string', 400);
        }

        if (!(float)$request['total']) {
            throw new \Exception('Total must be a valid number', 400);
        }

        return self::transform($request);
    }

    public static function transform(array $request): array
    {
        return [
            'product-id' => $request['product-id'],
            'quantity' => (int)$request['quantity'],
            'unit-price' => (float)$request['unit-price'],
            'total' => (float)$request['total']
        ];
    }
}
