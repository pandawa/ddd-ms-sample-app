<?php

declare(strict_types=1);

namespace Acme\Order\Domain\Relation;

use Acme\Order\Domain\Model\OrderLine;
use Acme\Order\Domain\Model\OrderLineMap;
use Pandawa\Component\Ddd\Collection;
use Pandawa\Component\Ddd\Relationship\HasMany;
use Pandawa\Component\Ddd\RelationshipBehaviorTrait;

/**
 * @property-read OrderLine[]|Collection $orderLines
 *
 * @author  Iqbal Maulana <iq.bluejack@gmail.com>
 */
trait HasManyOrderLines
{
    use RelationshipBehaviorTrait;

    public function orderLines(): HasMany
    {
        return $this->hasMany(OrderLineMap::class, 'order_id');
    }
}
