<?php

declare(strict_types=1);

namespace Acme\Inventory\Domain\Model;

use Acme\Product\Domain\Relation\BelongsToProduct;
use Pandawa\Reloquent\Map\EntityMap;

/**
 * @author  Iqbal Maulana <iq.bluejack@gmail.com>
 */
class InventoryMap extends EntityMap
{
    use BelongsToProduct;
}
