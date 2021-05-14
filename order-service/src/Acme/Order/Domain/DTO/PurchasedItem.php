<?php

declare(strict_types=1);

namespace Acme\Order\Domain\DTO;

use Acme\Product\Domain\Model\Product;

/**
 * @author  Iqbal Maulana <iq.bluejack@gmail.com>
 */
class PurchasedItem
{
    private Product $product;
    private int $qty;

    public function __construct(Product $product, int $qty)
    {
        $this->product = $product;
        $this->qty = $qty;
    }

    public function getProduct(): Product
    {
        return $this->product;
    }

    public function getQty(): int
    {
        return $this->qty;
    }
}
