<?php

namespace Supermarket;

class OfferXForY implements Offer
{
    private $amount;
    private $price;

    /**
     * OfferXForY constructor
     * @param float $amount
     * @param float $price
     */
    public function __construct(float $amount, float $price)
    {
        $this->amount = $amount;
        $this->price = $price;
    }

    /**
     * Calculates the discount
     * @param float $unitPrice
     * @param float $quantity
     * @return float
     */
    public function getDiscount(float $unitPrice, float $quantity): float
    {
        $discount = 0.0;
        if ($quantity >= $this->amount) {
            $discount = intdiv($quantity, $this->amount) *
                ($this->price - $this->amount * $unitPrice);
        }
        return $discount;
    }
}
