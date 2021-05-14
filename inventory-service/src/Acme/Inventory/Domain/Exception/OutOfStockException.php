<?php

declare(strict_types=1);

namespace Acme\Inventory\Domain\Exception;

use Acme\Inventory\Domain\Model\Inventory;

/**
 * @author  Iqbal Maulana <iq.bluejack@gmail.com>
 */
class OutOfStockException extends \Exception
{
    public function __construct(Inventory $inventory)
    {
        parent::__construct(sprintf('Product "%s" is out of stock.', $inventory->getProduct()->getName()), 400);
    }
}
