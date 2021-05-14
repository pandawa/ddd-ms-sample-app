<?php

declare(strict_types=1);

namespace Acme\Order\Domain\Event;

use Acme\Order\Domain\Collection\OrderLineCollection;
use Acme\Order\Domain\Model\Order;
use Acme\Order\Domain\ValueObject\OrderStatus;
use DateTime;
use Money\Money;
use Pandawa\Reloquent\Event\DomainEvent;

/**
 * @author  Iqbal Maulana <iq.bluejack@gmail.com>
 */
class OrderPurchased extends DomainEvent
{
    public function __construct(
        protected string $id,
        protected string $code,
        protected Money $amount,
        protected OrderStatus $status,
        protected DateTime $createdAt,
        protected OrderLineCollection $orderLines
    ) {
        parent::__construct();
    }

    public static function createFromOrder(Order $order): static
    {
        return new static(
            $order->getId(),
            $order->getCode(),
            $order->getAmount(),
            $order->getStatus(),
            $order->getCreatedAt(),
            $order->getOrderLines()
        );
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function getAmount(): Money
    {
        return $this->amount;
    }

    public function getStatus(): OrderStatus
    {
        return $this->status;
    }

    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    public function getOrderLines(): OrderLineCollection
    {
        return $this->orderLines;
    }
}
