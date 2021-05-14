<?php

declare(strict_types=1);

namespace Acme\Inventory\Domain\Relation;

use Acme\Inventory\Domain\Model\InventoryMap;
use Pandawa\Component\Ddd\Relationship\BelongsTo;
use Pandawa\Component\Ddd\RelationshipBehaviorTrait;

/**
 * @author  Iqbal Maulana <iq.bluejack@gmail.com>
 */
trait BelongsToInventory
{
    use RelationshipBehaviorTrait;

    public function inventory(): BelongsTo
    {
        return $this->belongsTo(InventoryMap::class);
    }
}
