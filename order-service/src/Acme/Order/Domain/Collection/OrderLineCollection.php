<?php

declare(strict_types=1);

namespace Acme\Order\Domain\Collection;

use Acme\Order\Domain\Model\OrderLine;
use InvalidArgumentException;
use Pandawa\Reloquent\Collection;

/**
 * @author  Iqbal Maulana <iq.bluejack@gmail.com>
 */
class OrderLineCollection extends Collection
{
    public function findByProductIdOrFail(string $productId): OrderLine
    {
        $orderLine = $this->first(fn(OrderLine $orderLine) => $orderLine->getProduct()->getId() === $productId);

        if (null === $orderLine) {
            throw new InvalidArgumentException(sprintf('Product with id "%s" not found.', $productId));
        }

        return $orderLine;
    }
}
