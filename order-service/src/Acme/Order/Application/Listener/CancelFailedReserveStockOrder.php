<?php

declare(strict_types=1);

namespace Acme\Order\Application\Listener;

use Acme\Inventory\Application\Event\StockReserveFailed;
use Acme\Order\Domain\Service\CancelOrderProcessor;

/**
 * @author  Iqbal Maulana <iq.bluejack@gmail.com>
 */
final class CancelFailedReserveStockOrder
{
    public function __construct(private CancelOrderProcessor $cancelOrderProcessor)
    {
    }

    public function handle(StockReserveFailed $event): void
    {
        $this->cancelOrderProcessor->cancel($event->getOrderId(), [
            'type'    => class_basename($event->getException()),
            'code'    => $event->getException()->getCode(),
            'message' => $event->getException()->getMessage(),
        ]);
    }
}
