<?php

declare(strict_types=1);

namespace Acme\Order\Domain\Service;

use Acme\Order\Domain\Contract\PurchaseOrder;
use Acme\Order\Domain\Factory\OrderFactory;
use Acme\Order\Domain\Model\Order;
use Acme\Order\Domain\Repository\OrderRepository;

/**
 * @author  Iqbal Maulana <iq.bluejack@gmail.com>
 */
final class PurchaseOrderProcessor
{
    public function __construct(
        private OrderRepository $orderRepository,
        private OrderFactory $orderFactory,
    ) {
    }

    public function purchase(PurchaseOrder $purchaseOrder): Order
    {
        $order = $this->orderFactory->createFromPurchaseOrder($purchaseOrder);

        return $this->orderRepository->save($order);
    }
}
