<?php

namespace service\Discounts;

use entity\Category;
use entity\DiscountedOrder;
use entity\OrderItem;
use repository\ProductRepository;

class ToolsDiscount
{
    private const DISCOUNT_PERCENT = 20;
    private const REQUIRED_QUANTITY = 2;
    private const DISCOUNT_MESSAGE = 'If you buy two or more products of category "Tools", you get a 20% discount on the cheapest product.';

    public static function applyDiscount(DiscountedOrder $discountedOrder): DiscountedOrder
    {
        $toolsQuantity = 0;
        $cheapestToolPrice = null;

        foreach($discountedOrder->getOrder()->getItems() as $orderItem) {
            /** @var OrderItem $orderItem */

            $product = ProductRepository::findById($orderItem->getProductId());

            if ($product->getCategory() === Category::TOOLS) {
                $toolsQuantity += $orderItem->getQuantity();

                $cheapestToolPrice = $cheapestToolPrice === null || $orderItem->getUnitPrice() < $cheapestToolPrice
                    ? $orderItem->getUnitPrice()
                    : $cheapestToolPrice;
            }
        }

        if ($toolsQuantity < self::REQUIRED_QUANTITY) {
            return $discountedOrder;
        }

        $discount = $cheapestToolPrice * (self::DISCOUNT_PERCENT / 100);

        return $discountedOrder->applyDiscountValue(
            $discount,
            self::DISCOUNT_MESSAGE
        );
    }
}
