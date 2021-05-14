<?php

declare(strict_types=1);

namespace Acme\Inventory\Domain\Model;

use Illuminate\Support\Str;
use Pandawa\Reloquent\Entity\Entity;

/**
 * @author  Iqbal Maulana <iq.bluejack@gmail.com>
 */
class StockItem extends Entity
{
    protected string $id;
    protected Inventory $inventory;
    protected int $qty;

    public function __construct()
    {
        $this->id = Str::uuid()->toString();
    }

    public static function create(Inventory $inventory, int $qty): static
    {
        $stockItem = new static();
        $stockItem->qty = $qty;
        $stockItem->setInventory($inventory);

        return $stockItem;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getInventory(): Inventory
    {
        return $this->inventory;
    }

    public function setInventory(Inventory $inventory): void
    {
        $this->inventory = $inventory;
    }

    public function getQty(): int
    {
        return $this->qty;
    }
}
