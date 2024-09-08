<?php

namespace service\Discounts;

use entity\Category;
use entity\DiscountedOrder;
use entity\OrderItem;
use entity\ValueObjects\Quantity;
use repository\ProductRepository;

class ToolsDiscount
{
    private const DISCOUNT_PERCENT = 20;
    private const REQUIRED_QUANTITY = 2;
    private const DISCOUNT_MESSAGE = 'If you buy two or more products of category "Tools", you get a 20% discount on the cheapest product.';

    public static function applyDiscount(DiscountedOrder $discountedOrder): DiscountedOrder
    {
        $toolsQuantity = Quantity::make(0);
        $cheapestToolPrice = null;

        foreach($discountedOrder->getOrder()->getItems() as $orderItem) {
            /** @var OrderItem $orderItem */

            $product = ProductRepository::findById($orderItem->getProductId());

            if ($product->getCategory() === Category::TOOLS) {
                $toolsQuantity = $toolsQuantity->add($orderItem->getQuantity());

                if ($cheapestToolPrice === null) {
                    $cheapestToolPrice = $orderItem->getUnitPrice();
                } else if ($orderItem->getUnitPrice()->isCheaperThan($cheapestToolPrice)) {
                    $cheapestToolPrice = $orderItem->getUnitPrice();
                }
            }
        }

        if ($toolsQuantity->isLessThan(self::REQUIRED_QUANTITY)) {
            return $discountedOrder;
        }

        $discount = $cheapestToolPrice->getDiscountPercentValue(self::DISCOUNT_PERCENT);

        return $discountedOrder->applyDiscountValue(
            $discount,
            self::DISCOUNT_MESSAGE
        );
    }
}
