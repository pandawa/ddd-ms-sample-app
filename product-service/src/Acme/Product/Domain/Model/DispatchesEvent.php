<?php

declare(strict_types=1);

namespace Acme\Product\Domain\Model;

use Acme\Product\Domain\Observer\ProductObserver;
use Pandawa\Component\Ddd\AbstractModel;

/**
 * @author  Iqbal Maulana <iq.bluejack@gmail.com>
 *
 * @mixin AbstractModel
 */
trait DispatchesEvent
{
    protected static function bootDispatchesEvent(): void
    {
        static::observe(ProductObserver::class);
    }
}
