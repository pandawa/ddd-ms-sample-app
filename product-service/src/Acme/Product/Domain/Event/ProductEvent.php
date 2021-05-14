<?php

declare(strict_types=1);

namespace Acme\Product\Domain\Event;

use Acme\Product\Domain\Model\Product;

/**
 * @author  Iqbal Maulana <iq.bluejack@gmail.com>
 */
abstract class ProductEvent
{
    public function __construct(protected Product $product)
    {
    }

    public function getProduct(): Product
    {
        return $this->product;
    }
}
