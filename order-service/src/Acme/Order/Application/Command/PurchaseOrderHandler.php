<?php

declare(strict_types=1);

namespace Acme\Order\Application\Command;

use Acme\Order\Domain\Model\Order;
use Acme\Order\Domain\Service\PurchaseOrderProcessor;

/**
 * @author  Iqbal Maulana <iq.bluejack@gmail.com>
 */
final class PurchaseOrderHandler
{
    public function __construct(private PurchaseOrderProcessor $purchaseOrderProcessor)
    {
    }

    public function handle(PurchaseOrder $purchaseOrder): Order
    {
        return $this->purchaseOrderProcessor->purchase($purchaseOrder);
    }
}
