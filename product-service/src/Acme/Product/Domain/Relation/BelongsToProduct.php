<?php

declare(strict_types=1);

namespace Acme\Product\Domain\Relation;

use Acme\Product\Domain\Model\ProductMap;
use Pandawa\Component\Ddd\Relationship\BelongsTo;
use Pandawa\Component\Ddd\RelationshipBehaviorTrait;

/**
 * @author  Iqbal Maulana <iq.bluejack@gmail.com>
 */
trait BelongsToProduct
{
    use RelationshipBehaviorTrait;

    public function product(): BelongsTo
    {
        return $this->belongsTo(ProductMap::class);
    }
}
