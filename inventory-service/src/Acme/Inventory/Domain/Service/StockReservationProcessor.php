<?php

declare(strict_types=1);

namespace Acme\Inventory\Domain\Service;

use Acme\Inventory\Domain\Contract\ReserveStock;
use Acme\Inventory\Domain\Factory\StockReservationFactory;
use Acme\Inventory\Domain\Model\StockReservation;
use Acme\Inventory\Domain\Repository\StockReservationRepository;

/**
 * @author  Iqbal Maulana <iq.bluejack@gmail.com>
 */
final class StockReservationProcessor
{
    public function __construct(
        private StockReservationFactory $stockReservationFactory,
        private StockReservationRepository $stockReservationRepository,
    ) {
    }

    public function reserve(ReserveStock $reserveStock): StockReservation
    {
        $reservation = $this->stockReservationFactory->createFromReserveStock($reserveStock);

        return $this->stockReservationRepository->save($reservation);
    }
}
