<?php

declare(strict_types=1);

namespace Acme\Common\Domain\Model;

use Illuminate\Database\Eloquent\SoftDeletes;
use Pandawa\Reloquent\Map\EntityMap;

/**
 * @author  Iqbal Maulana <iq.bluejack@gmail.com>
 */
class CategoryMap extends EntityMap
{
    use SoftDeletes;
}
