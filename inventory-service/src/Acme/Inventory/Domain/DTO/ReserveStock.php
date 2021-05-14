<?php

declare(strict_types=1);

namespace Acme\Inventory\Domain\DTO;

use Acme\Inventory\Domain\Contract\ReserveStock as ReserveStockContract;
use Acme\Order\Domain\Collection\OrderLineCollection;

/**
 * @author  Iqbal Maulana <iq.bluejack@gmail.com>
 */
class ReserveStock implements ReserveStockContract
{
    public function __construct(protected string $orderId, protected OrderLineCollection $orderLines)
    {
    }

    public function getOrderId(): string
    {
        return $this->orderId;
    }

    public function getOrderLines(): OrderLineCollection
    {
        return $this->orderLines;
    }
}
