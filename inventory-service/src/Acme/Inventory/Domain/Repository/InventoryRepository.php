<?php

declare(strict_types=1);

namespace Acme\Inventory\Domain\Repository;

use Illuminate\Database\Eloquent\Builder;
use Pandawa\Reloquent\Collection;
use Pandawa\Reloquent\Repository;

/**
 * @author  Iqbal Maulana <iq.bluejack@gmail.com>
 */
class InventoryRepository extends Repository
{
    public function findByProductIds(array $productIds): Collection
    {
        $qb = $this->createQueryBuilder();

        $qb->whereHas('product', function (Builder $qb) use ($productIds) {
            $qb->whereIn('id', $productIds);
        });

        return $this->execute($qb);
    }
}
