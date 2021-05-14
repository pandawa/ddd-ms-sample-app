<?php

declare(strict_types=1);

namespace Acme\Inventory\Domain\Event;

use Acme\Inventory\Domain\Model\StockReservation;
use Pandawa\Reloquent\Event\DomainEvent;

/**
 * @author  Iqbal Maulana <iq.bluejack@gmail.com>
 */
class StockReserved extends DomainEvent
{
    protected string $orderId;
    protected string $reservationId;
    protected int $totalQty;

    public function __construct(string $orderId, string $reservationId, int $totalQty)
    {
        parent::__construct();

        $this->orderId = $orderId;
        $this->reservationId = $reservationId;
        $this->totalQty = $totalQty;
    }

    public static function createFromReservation(StockReservation $stockReservation): static
    {
        return new static(
            $stockReservation->getOrderId(),
            $stockReservation->getId(),
            $stockReservation->getTotalQty()
        );
    }

    public function getOrderId(): string
    {
        return $this->orderId;
    }

    public function getReservationId(): string
    {
        return $this->reservationId;
    }

    public function getTotalQty(): int
    {
        return $this->totalQty;
    }
}
