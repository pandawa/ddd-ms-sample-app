<?php

declare(strict_types=1);

namespace Acme\Inventory\Domain\Relation;

use Acme\Inventory\Domain\Model\StockItemMap;
use Pandawa\Component\Ddd\Relationship\HasMany;
use Pandawa\Component\Ddd\RelationshipBehaviorTrait;

/**
 * @author  Iqbal Maulana <iq.bluejack@gmail.com>
 */
trait HasManyStockItems
{
    use RelationshipBehaviorTrait;

    public function stockItems(): HasMany
    {
        return $this->hasMany(StockItemMap::class, 'stock_reservation_id');
    }
}
