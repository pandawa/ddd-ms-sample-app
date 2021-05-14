<?php

declare(strict_types=1);

namespace Acme\Order\Domain\Event;

use Acme\Order\Domain\ValueObject\OrderStatus;
use Pandawa\Reloquent\Event\DomainEvent;

/**
 * @author  Iqbal Maulana <iq.bluejack@gmail.com>
 */
class OrderStateChanged extends DomainEvent
{
    public function __construct(protected string $orderId, protected OrderStatus $status)
    {
    }

    public function getOrderId(): string
    {
        return $this->orderId;
    }

    public function getStatus(): OrderStatus
    {
        return $this->status;
    }
}
