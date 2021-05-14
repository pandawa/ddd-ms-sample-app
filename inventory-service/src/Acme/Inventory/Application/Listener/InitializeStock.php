<?php

declare(strict_types=1);

namespace Acme\Inventory\Application\Listener;

use Acme\Inventory\Domain\Model\Inventory;
use Acme\Inventory\Domain\Repository\InventoryRepository;
use Acme\Product\Domain\Event\ProductCreated;

/**
 * @author  Iqbal Maulana <iq.bluejack@gmail.com>
 */
final class InitializeStock
{
    protected bool $afterCommit = true;

    public function __construct(private InventoryRepository $repository)
    {
    }

    public function handle(ProductCreated $event): void
    {
        $inventory = new Inventory();
        $inventory->setProduct($event->getProduct());

        $this->repository->save($inventory);
    }
}
