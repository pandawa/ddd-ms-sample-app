<?php

declare(strict_types=1);

namespace Tests\Unit;

use Acme\Inventory\Domain\DTO\ReserveStock;
use Acme\Inventory\Domain\Model\Inventory;
use Acme\Inventory\Domain\Model\InventoryMap;
use Acme\Inventory\Domain\Service\StockReservationProcessor;
use Acme\Order\Domain\Collection\OrderLineCollection;
use Acme\Order\Domain\Model\OrderLine;
use Acme\Product\Domain\Model\Product;
use Illuminate\Support\Str;
use Tests\TestCase;

/**
 * @author  Iqbal Maulana <iq.bluejack@gmail.com>
 */
class ReserveStockTest extends TestCase
{
    public function testReserveStock(): void
    {
        $product = $this->getProduct();
        $stockReservation = $this->stockReservationProcessor()->reserve(new ReserveStock(
            Str::uuid()->toString(),
            new OrderLineCollection([
                OrderLine::create($product, 1)
            ])
        ));
        $inventory = $this->getInventoryByProduct($product->getId());

        $this->assertSame(0, $inventory->getStock());
        $this->assertSame(1, $stockReservation->getTotalQty());
        $this->assertCount(1, $stockReservation->getStockItems());
        $this->assertSame($inventory->getId(), $stockReservation->getStockItems()->first()->getInventory()->getId());
        $this->assertSame(1, $stockReservation->getStockItems()->first()->getQty());
    }

    private function stockReservationProcessor(): StockReservationProcessor
    {
        return $this->app->get(StockReservationProcessor::class);
    }

    private function getInventoryByProduct(string $product): Inventory
    {
        return InventoryMap::query()->where('product_id', $product)->first();
    }

    private function getProduct(): Product
    {
        $qb = InventoryMap::query();
        $qb->where('stock', '>', 0);

        return $qb->first()->product;
    }
}
