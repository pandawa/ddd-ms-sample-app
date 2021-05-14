<?php

declare(strict_types=1);

namespace Acme\Product\Domain\Repository;

use Pandawa\Component\Ddd\Collection;
use Pandawa\Reloquent\Repository;

/**
 * @author  Iqbal Maulana <iq.bluejack@gmail.com>
 */
class ProductRepository extends Repository
{
    public function findInIds(array $ids): Collection
    {
        return $this->execute(
            $this->createQueryBuilder()
                ->whereIn('id', $ids)
        );
    }
}
