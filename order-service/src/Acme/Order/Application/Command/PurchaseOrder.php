<?php

declare(strict_types=1);

namespace Acme\Order\Application\Command;

use Pandawa\Component\Message\AbstractCommand;
use Pandawa\Component\Message\NameableMessageInterface;
use Pandawa\Component\Support\NameableClassTrait;
use Acme\Order\Domain\Contract\PurchaseOrder as PurchaseOrderContract;

/**
 * @author  Iqbal Maulana <iq.bluejack@gmail.com>
 */
class PurchaseOrder extends AbstractCommand implements NameableMessageInterface, PurchaseOrderContract
{
    use NameableClassTrait;

    protected array $orderItems;

    public function getOrderItems(): array
    {
        return $this->orderItems;
    }
}
