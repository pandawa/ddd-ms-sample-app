<?php

declare(strict_types=1);

namespace Acme\Order\Domain\Service;

/**
 * @author  Iqbal Maulana <iq.bluejack@gmail.com>
 */
final class ReceiptGenerator
{
    public function generate(): string
    {
        return sprintf('PO-%s', uniqid());
    }
}
