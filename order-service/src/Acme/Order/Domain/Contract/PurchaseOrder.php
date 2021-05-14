<?php

declare(strict_types=1);

namespace Acme\Order\Domain\Contract;

/**
 * @author  Iqbal Maulana <iq.bluejack@gmail.com>
 */
interface PurchaseOrder
{
    public function getOrderItems(): array;
}
