<?php

declare(strict_types=1);

namespace Acme\Order\Domain\Factory;

use Acme\Order\Domain\Contract\PurchaseOrder;
use Acme\Order\Domain\DTO\PurchasedItem;
use Acme\Order\Domain\Model\Order;
use Acme\Order\Domain\Service\ReceiptGenerator;
use Acme\Product\Domain\Repository\ProductRepository;
use Illuminate\Support\Arr;
use Pandawa\Component\Ddd\Collection;

/**
 * @author  Iqbal Maulana <iq.bluejack@gmail.com>
 */
final class OrderFactory
{
    public function __construct(
        private ProductRepository $productRepository,
        private ReceiptGenerator $receiptGenerator,
    ) {
    }

    public function createFromPurchaseOrder(PurchaseOrder $purchaseOrder): Order
    {
        $products = $this->findProducts($orderItems = $purchaseOrder->getOrderItems());

        return Order::create(
            $this->receiptGenerator->generate(),
            array_map(
                fn(array $item) => new PurchasedItem(
                    $products->find($item['product']),
                    $item['qty']
                ),
                $orderItems
            )
        );
    }

    private function findProducts(array $items): Collection
    {
        return $this->productRepository->findInIds(Arr::pluck($items, 'product'));
    }
}
