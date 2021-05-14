<?php

declare(strict_types=1);

namespace Acme\Order\Application\Listener;

use Acme\Inventory\Domain\Event\StockReserved;
use Acme\Order\Domain\Service\OrderFinalizer;

/**
 * @author  Iqbal Maulana <iq.bluejack@gmail.com>
 */
final class FinalizeCreatingOrder
{
    public function __construct(private OrderFinalizer $orderFinalizer)
    {
    }

    public function handle(StockReserved $event): void
    {
        $this->orderFinalizer->finalize($event->getOrderId());
    }
}
