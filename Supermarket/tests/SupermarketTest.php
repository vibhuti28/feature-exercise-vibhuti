<?php

namespace Tests;

use Supermarket\Catalog;
use Supermarket\Checkout;
use Supermarket\OfferXForY;
use Supermarket\OfferSpecialCase;
use PHPUnit\Framework\TestCase;

class SupermarketTest extends TestCase
{
    /**
     * @dataProvider totalTestCases
     * @param string $items
     * @param float  $total
     */
    public function testTotalPrice(string $items, float $total)
    {
        // Setup data object
        $checkout = new Checkout(new Catalog([
            'A' => 50,
            'B' => 30,
            'C' => 20,
            'D' => 15,
            'E' => 5,
        ]), [
            'A' => new OfferXForY(3, 130),
            'B' => new OfferXForY(2, 45),
            'C' => new OfferSpecialCase([2 => 38,3 => 50]),
        ]);
        foreach (str_split($items) as $item) {
            $checkout->scanItems($item);
        }
        // Perform Assert operation
        self::assertEquals($total, $checkout->getTotalPrice());
    }

    public function totalTestCases()
    {
        return [
            'no items' => ['', 0],
            'A' => ['A', 50],
            'AA' => ['AA', 100],
            'AAA' => ['AAA', 130],
            'AAAA' => ['AAAA', 180],
            'AAAAAA' => ['AAAAAA', 260],
            'AAAAAA' => ['AAAAAAA', 310],
            'C' => ['C', 20],
            'CCCC' => ['CCCC', 70],
            'CCCCC' => ['CCCCC', 90],
            'E' => ['EE', 10],
        ];
    }
}
