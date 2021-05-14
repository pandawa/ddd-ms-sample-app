<?php

declare(strict_types=1);

namespace Acme\Inventory\Domain\Factory;

use Acme\Inventory\Domain\Contract\ReserveStock;
use Acme\Inventory\Domain\DTO\ReservedItem;
use Acme\Inventory\Domain\Model\Inventory;
use Acme\Inventory\Domain\Model\StockReservation;
use Acme\Inventory\Domain\Repository\InventoryRepository;
use Acme\Order\Domain\Collection\OrderLineCollection;
use Acme\Order\Domain\Model\OrderLine;
use Illuminate\Support\Arr;
use Pandawa\Reloquent\Collection;

/**
 * @author  Iqbal Maulana <iq.bluejack@gmail.com>
 */
final class StockReservationFactory
{
    public function __construct(private InventoryRepository $inventoryRepository)
    {
    }

    public function createFromReserveStock(ReserveStock $reserveStock): StockReservation
    {
        $inventories = $this->findInventoriesByOrderLines($orderLines = $reserveStock->getOrderLines());

        return StockReservation::create(
            $reserveStock->getOrderId(),
            $orderLines
                ->map(fn(OrderLine $orderLine) => new ReservedItem(
                    $inventories->first(fn(Inventory $inventory) => $inventory->getProduct()->getId() === $orderLine->getProduct()->getId()),
                    $orderLine->getQty()
                ))
                ->toArray()
        );
    }

    protected function findInventoriesByOrderLines(OrderLineCollection $orderLineCollection): Collection
    {
        $orderLines = $orderLineCollection->toArray();

        return $this->inventoryRepository->findByProductIds(Arr::pluck($orderLines, 'product.id'));
    }
}
