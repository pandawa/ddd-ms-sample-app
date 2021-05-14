<?php

declare(strict_types=1);

namespace Acme\Product\Domain\Model;

use Acme\Common\Domain\Relation\BelongsToCategory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Pandawa\Reloquent\Map\EntityMap;

/**
 * @author  Iqbal Maulana <iq.bluejack@gmail.com>
 */
class ProductMap extends EntityMap
{
    use SoftDeletes;
    use DispatchesEvent;
    use BelongsToCategory;
}
