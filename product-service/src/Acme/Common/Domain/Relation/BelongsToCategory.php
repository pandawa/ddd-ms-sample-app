<?php

declare(strict_types=1);

namespace Acme\Common\Domain\Relation;

use Acme\Common\Domain\Model\CategoryMap;
use Pandawa\Component\Ddd\Relationship\BelongsTo;
use Pandawa\Component\Ddd\RelationshipBehaviorTrait;

/**
 * @author  Iqbal Maulana <iq.bluejack@gmail.com>
 */
trait BelongsToCategory
{
    use RelationshipBehaviorTrait;

    public function category(): BelongsTo
    {
        return $this->belongsTo(CategoryMap::class);
    }
}
