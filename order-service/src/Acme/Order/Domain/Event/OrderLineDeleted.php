<?php

declare(strict_types=1);

namespace Acme\Order\Domain\Event;

use Pandawa\Reloquent\Event\DomainEvent;

/**
 * @author  Iqbal Maulana <iq.bluejack@gmail.com>
 */
class OrderLineDeleted extends DomainEvent
{
    public function __construct(protected string $orderId, protected string $orderLineId)
    {
        parent::__construct();
    }

    public function getOrderId(): string
    {
        return $this->orderId;
    }

    public function getOrderLineId(): string
    {
        return $this->orderLineId;
    }
}
