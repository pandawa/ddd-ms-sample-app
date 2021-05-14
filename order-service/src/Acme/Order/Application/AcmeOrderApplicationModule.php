<?php

declare(strict_types=1);

namespace Acme\Order\Application;

use Acme\Inventory\Application\Event\StockReserveFailed;
use Acme\Inventory\Domain\Event\StockReserved;
use Acme\Order\Application\Listener\CancelFailedReserveStockOrder;
use Acme\Order\Application\Listener\FinalizeCreatingOrder;
use Pandawa\Component\Module\AbstractModule;
use Pandawa\Component\Module\Provider\EventProviderTrait;

/**
 * @author  Iqbal Maulana <iq.bluejack@gmail.com>
 */
class AcmeOrderApplicationModule extends AbstractModule
{
    use EventProviderTrait;

    public function listens(): array
    {
        return [
            StockReserved::class => [
                FinalizeCreatingOrder::class,
            ],
            StockReserveFailed::class => [
                CancelFailedReserveStockOrder::class,
            ]
        ];
    }
}
