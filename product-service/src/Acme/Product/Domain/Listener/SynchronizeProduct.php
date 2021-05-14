<?php

declare(strict_types=1);

namespace Acme\Product\Domain\Listener;

use Acme\Product\Domain\Event\ProductCreated;
use Acme\Product\Domain\Event\ProductDeleted;
use Acme\Product\Domain\Event\ProductUpdated;
use Acme\Product\Domain\Model\Product;
use Acme\Product\Domain\Model\ProductMap;
use Acme\Product\Domain\Repository\ProductRepository;
use Illuminate\Support\Arr;
use InvalidArgumentException;
use Pandawa\Reloquent\Entity\EntityFactory;

/**
 * @author  Iqbal Maulana <iq.bluejack@gmail.com>
 */
class SynchronizeProduct
{
    public function __construct(private ProductRepository $repository)
    {
    }

    public function create(ProductCreated $event): void
    {
        $product = EntityFactory::create(Product::class);
        $product->fill($event->getProduct()->toArray());

        ProductMap::withoutEvents(fn() => $this->repository->save($product));
    }

    public function update(ProductUpdated $event): void
    {
        if (null === $product = $this->repository->find($productId = $event->getProduct()->getId())) {
            throw new InvalidArgumentException(sprintf('Product with id "%s" is not found.', $productId));
        }

        $product->fill(Arr::except($event->getProduct()->toArray(), ['id']));

        ProductMap::withoutEvents(fn() => $this->repository->save($product));
    }

    public function delete(ProductDeleted $event): void
    {
        if (null !== $product = $this->repository->find($productId = $event->getProduct()->getId())) {
            ProductMap::withoutEvents(fn() => $this->repository->remove($product));
        }
    }
}
