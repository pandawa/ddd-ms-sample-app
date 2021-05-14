<?php

declare(strict_types=1);

namespace Acme\Inventory\Domain\Contract;

use Acme\Order\Domain\Collection\OrderLineCollection;

/**
 * @author  Iqbal Maulana <iq.bluejack@gmail.com>
 */
interface ReserveStock
{
    public function getOrderId(): string;

    public function getOrderLines(): OrderLineCollection;
}
