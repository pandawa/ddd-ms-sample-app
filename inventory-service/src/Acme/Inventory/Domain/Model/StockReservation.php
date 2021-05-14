<?php

declare(strict_types=1);

namespace Acme\Inventory\Domain\Model;

use Acme\Inventory\Domain\DTO\ReservedItem;
use Acme\Inventory\Domain\Event\StockReserved;
use Acme\Inventory\Domain\Exception\OutOfStockException;
use Illuminate\Support\Str;
use Pandawa\Reloquent\Collection;
use Pandawa\Reloquent\Entity\AggregateRoot;

/**
 * @author  Iqbal Maulana <iq.bluejack@gmail.com>
 */
class StockReservation extends AggregateRoot
{
    protected string $id;
    protected string $orderId;
    protected int $totalQty;
    protected Collection $stockItems;

    public function __construct()
    {
        $this->id = Str::uuid()->toString();
        $this->totalQty = 0;
        $this->stockItems = new Collection();
    }

    /**
     * @param string         $orderId
     * @param ReservedItem[] $items
     *
     * @return static
     * @throws OutOfStockException
     */
    public static function create(string $orderId, array $items): static
    {
        $stockReservation = new static();
        $stockReservation->orderId = $orderId;

        foreach ($items as $item) {
            $stockReservation->add($item->getInventory(), $item->getQty());
        }

        return $stockReservation->addEvent(StockReserved::createFromReservation($stockReservation));
    }

    public function add(Inventory $inventory, int $qty): void
    {
        if ($inventory->getStock() < $qty) {
            throw new OutOfStockException($inventory);
        }

        $inventory->setStock($inventory->getStock() - $qty);
        $this->stockItems->add(StockItem::create($inventory, $qty));
        $this->totalQty += $qty;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getOrderId(): string
    {
        return $this->orderId;
    }

    public function getTotalQty(): int
    {
        return $this->totalQty;
    }

    public function getStockItems(): Collection
    {
        return $this->stockItems;
    }
}
