<?php

declare(strict_types=1);

namespace Acme\Inventory\Application\Listener;

use Acme\Inventory\Application\DTO\ExceptionBag;
use Acme\Inventory\Application\Event\StockReserveFailed;
use Acme\Inventory\Domain\DTO\ReserveStock as ReserveStockDTO;
use Acme\Inventory\Domain\Service\StockReservationProcessor;
use Acme\Order\Domain\Event\OrderPurchased;
use Illuminate\Contracts\Events\Dispatcher;

/**
 * @author  Iqbal Maulana <iq.bluejack@gmail.com>
 */
final class ReserveStock
{
    public bool $afterCommit = true;

    public function __construct(
        private StockReservationProcessor $stockReservationProcessor,
        private Dispatcher $dispatcher,
    ) {
    }

    public function handle(OrderPurchased $event): void
    {
        try {
            $this->stockReservationProcessor->reserve(new ReserveStockDTO(
                $event->getId(),
                $event->getOrderLines()
            ));
        } catch (\Exception $e) {
            $this->dispatcher->dispatch(new StockReserveFailed($event->getId(), ExceptionBag::createFromException($e)));
        }
    }
}
