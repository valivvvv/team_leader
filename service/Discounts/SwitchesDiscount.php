<?php

declare(strict_types=1);

namespace service\Discounts;

use entity\Category;
use entity\DiscountedOrder;
use entity\OrderItem;
use entity\ValueObjects\Quantity;
use repository\ProductRepository;

class SwitchesDiscount
{
    private const REQUIRED_QUANTITY = 5;
    private const DISCOUNT_MESSAGE = 'For every product of category "Switches", when you buy five, you get a sixth for free.';

    public static function applyDiscount(DiscountedOrder $discountedOrder): DiscountedOrder
    {
        foreach($discountedOrder->getOrder()->getItems() as $orderItem) {
            /** @var OrderItem $orderItem */

            $product = ProductRepository::findById($orderItem->getProductId());

            if (
                $product->getCategory() === Category::SWITCHES
                && $orderItem->getQuantity()->greaterThanOrEqual(self::REQUIRED_QUANTITY)
            ) {
                $quantityToAdd = Quantity::make(
                    intdiv($orderItem->getQuantity()->getQuantity(), self::REQUIRED_QUANTITY)
                );

                $discountedOrder = $discountedOrder->addItemQuantity(
                    $product->getId(),
                    $quantityToAdd,
                    self::DISCOUNT_MESSAGE
                );
            }
        }

        return $discountedOrder;
    }
}
