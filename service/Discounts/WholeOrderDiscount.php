<?php

declare(strict_types=1);

namespace service\Discounts;

use entity\DiscountedOrder;
use entity\ValueObjects\Money;
use repository\CustomerRepository;

class WholeOrderDiscount
{
    private const REVENUE_THRESHOLD = '1000';
    private const DISCOUNT_PERCENT = 10;
    private const DISCOUNT_MESSAGE = 'A customer who has already bought for over € 1000, gets a discount of 10% on the whole order.';

    public static function applyDiscount(DiscountedOrder $discountedOrder): DiscountedOrder
    {
        $customer = CustomerRepository::findById($discountedOrder->getOrder()->getCustomerId());

        if ($customer->getRevenue()->isCheaperOrEqualThan(Money::make((float)self::REVENUE_THRESHOLD))) {
            return $discountedOrder;
        }

        return $discountedOrder->applyDiscountPercent(
            self::DISCOUNT_PERCENT,
            self::DISCOUNT_MESSAGE
        );
    }
}
