<?php

declare(strict_types=1);

namespace Acme\Order\Domain\Service;

use Acme\Order\Domain\Model\Order;
use Acme\Order\Domain\Repository\OrderRepository;

/**
 * @author  Iqbal Maulana <iq.bluejack@gmail.com>
 */
final class OrderFinalizer
{
    public function __construct(private OrderRepository $orderRepository)
    {
    }

    public function finalize(string $orderId): Order
    {
        $order = $this->orderRepository->find($orderId)->finalize();

        return $this->orderRepository->save($order);
    }
}
