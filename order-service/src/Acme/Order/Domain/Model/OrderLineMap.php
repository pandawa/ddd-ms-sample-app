<?php

declare(strict_types=1);

namespace Acme\Order\Domain\Model;

use Acme\Order\Domain\Collection\OrderLineCollection;
use Acme\Product\Domain\Relation\BelongsToProduct;
use Pandawa\Component\Ddd\CollectionInterface;
use Pandawa\Reloquent\Map\EntityMap;

/**
 * @author  Iqbal Maulana <iq.bluejack@gmail.com>
 */
class OrderLineMap extends EntityMap
{
    use BelongsToProduct;

    public function newCollection(array $entities = []): CollectionInterface
    {
        return new OrderLineCollection($entities);
    }
}
