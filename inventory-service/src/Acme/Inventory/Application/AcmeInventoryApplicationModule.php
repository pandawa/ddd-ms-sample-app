<?php

declare(strict_types=1);

namespace Acme\Inventory\Application;

use Acme\Inventory\Application\Listener\InitializeStock;
use Acme\Inventory\Application\Listener\ReserveStock;
use Acme\Order\Domain\Event\OrderPurchased;
use Acme\Product\Domain\Event\ProductCreated;
use Pandawa\Component\Module\AbstractModule;
use Pandawa\Component\Module\Provider\EventProviderTrait;

/**
 * @author  Iqbal Maulana <iq.bluejack@gmail.com>
 */
class AcmeInventoryApplicationModule extends AbstractModule
{
    use EventProviderTrait;

    protected function listens(): array
    {
        return [
            ProductCreated::class => [
                InitializeStock::class,
            ],
            OrderPurchased::class => [
                ReserveStock::class,
            ]
        ];
    }
}
