<?php

declare(strict_types=1);

namespace Acme\Product\Domain\Observer;

use Acme\Product\Domain\Event\ProductCreated;
use Acme\Product\Domain\Event\ProductDeleted;
use Acme\Product\Domain\Event\ProductUpdated;
use Acme\Product\Domain\Model\Product;
use Acme\Product\Domain\Model\ProductMap;

/**
 * @author  Iqbal Maulana <iq.bluejack@gmail.com>
 */
final class ProductObserver
{
    public bool $afterCommit = true;

    public function created(ProductMap $product): void
    {
        event(new ProductCreated($product->hydrateToEntity()));
    }

    public function updated(ProductMap $product): void
    {
        event(new ProductUpdated($product->hydrateToEntity()));
    }

    public function deleted(ProductMap $product): void
    {
        event(new ProductDeleted($product->hydrateToEntity()));
    }
}
