<?php

declare(strict_types=1);

namespace Acme\Inventory\Domain\Model;

use Acme\Inventory\Domain\Relation\HasManyStockItems;
use Pandawa\Reloquent\Map\EntityMap;

/**
 * @author  Iqbal Maulana <iq.bluejack@gmail.com>
 */
class StockReservationMap extends EntityMap
{
    use HasManyStockItems;
}
