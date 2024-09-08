<?php

declare(strict_types=1);

namespace validation;

class OrderValidation
{
    /**
     * @throws \Exception
     */
    public static function validate(array $request): array
    {
        if (!isset($request['id'])) {
            throw new \Exception('Order ID is required', 400);
        }

        if (!isset($request['customer-id'])) {
            throw new \Exception('Customer ID is required', 400);
        }

        if (!isset($request['items'])) {
            throw new \Exception('Items are required', 400);
        }

        if (!isset($request['total'])) {
            throw new \Exception('Total is required', 400);
        }

        if (!is_string($request['id'])) {
            throw new \Exception('Order ID must be a string', 400);
        }

        if (!is_string($request['customer-id'])) {
            throw new \Exception('Customer ID must be a string', 400);
        }

        if (!is_array($request['items'])) {
            throw new \Exception('Items must be an array', 400);
        }

        if (!is_string($request['total'])) {
            throw new \Exception('Total must be a string', 400);
        }

        if (!(float)$request['total']) {
            throw new \Exception('Total must be a valid number', 400);
        }

        $request['items'] = array_map(static function (array $item) {
            return OrderItemValidation::validate($item);
        }, $request['items']);


        return self::transform($request);
    }

    public static function transform(array $request): array
    {
        return [
            'id' => $request['id'],
            'customer-id' => $request['customer-id'],
            'items' => $request['items'],
            'total' => (float)$request['total']
        ];
    }
}
