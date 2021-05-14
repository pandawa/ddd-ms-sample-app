<?php

declare(strict_types=1);

namespace Acme\Order\Domain\ValueObject;

use Acme\Shared\Enum\Enum;

/**
 * @author  Iqbal Maulana <iq.bluejack@gmail.com>
 */
class OrderStatus extends Enum
{
    const CREATED = 'created';
    const PENDING = 'pending';
    const CANCELED = 'canceled';
}
