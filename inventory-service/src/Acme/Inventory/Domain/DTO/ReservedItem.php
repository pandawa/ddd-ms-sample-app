<?php

declare(strict_types=1);

namespace Acme\Inventory\Domain\DTO;

use Acme\Inventory\Domain\Model\Inventory;

/**
 * @author  Iqbal Maulana <iq.bluejack@gmail.com>
 */
class ReservedItem
{
    public function __construct(protected Inventory $inventory, protected int $qty)
    {
    }

    public function getInventory(): Inventory
    {
        return $this->inventory;
    }

    public function getQty(): int
    {
        return $this->qty;
    }
}
