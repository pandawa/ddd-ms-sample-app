<?php

declare(strict_types=1);

namespace Acme\Inventory\Application\Event;

use Acme\Inventory\Application\DTO\ExceptionBag;

/**
 * @author  Iqbal Maulana <iq.bluejack@gmail.com>
 */
class StockReserveFailed
{
    public function __construct(protected string $orderId, protected ExceptionBag $exception)
    {
    }

    public function getOrderId(): string
    {
        return $this->orderId;
    }

    public function getException(): ExceptionBag
    {
        return $this->exception;
    }
}
