<?php

declare(strict_types=1);

namespace Acme\Order\Domain\Model;

use Acme\Order\Domain\Relation\HasManyOrderLines;
use Acme\Order\Domain\ValueObject\OrderStatus;
use Acme\Shared\Money\MoneyCast;
use Pandawa\Reloquent\Map\EntityMap;

/**
 * @author  Iqbal Maulana <iq.bluejack@gmail.com>
 */
class OrderMap extends EntityMap
{
    use HasManyOrderLines;

    protected $casts = [
        'status' => OrderStatus::class,
        'amount' => MoneyCast::class,
        'remark' => 'array',
    ];
}
