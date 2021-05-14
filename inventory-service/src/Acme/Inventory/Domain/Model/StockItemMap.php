<?php

declare(strict_types=1);

namespace Acme\Inventory\Domain\Model;

use Acme\Inventory\Domain\Relation\BelongsToInventory;
use Pandawa\Reloquent\Map\EntityMap;

/**
 * @author  Iqbal Maulana <iq.bluejack@gmail.com>
 */
class StockItemMap extends EntityMap
{
    use BelongsToInventory;
}
