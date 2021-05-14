<?php

declare(strict_types=1);

namespace Acme\Order\Domain\Service;

use Acme\Order\Domain\Model\Order;
use Acme\Order\Domain\Repository\OrderRepository;

/**
 * @author  Iqbal Maulana <iq.bluejack@gmail.com>
 */
final class CancelOrderProcessor
{
    public function __construct(private OrderRepository $orderRepository)
    {
    }

    public function cancel(string $id, array $remark = []): Order
    {
        $order = $this->orderRepository->find($id);
        $order->cancel($remark);

        return $this->orderRepository->save($order);
    }
}
