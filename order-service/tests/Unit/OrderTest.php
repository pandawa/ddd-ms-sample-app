<?php

declare(strict_types=1);

namespace Tests\Unit;

use Acme\Order\Domain\Contract\PurchaseOrder;
use Acme\Order\Domain\Model\Order;
use Acme\Order\Domain\Model\OrderLine;
use Acme\Order\Domain\Model\OrderLineMap;
use Acme\Order\Domain\Model\OrderMap;
use Acme\Order\Domain\Repository\OrderRepository;
use Acme\Order\Domain\Service\PurchaseOrderProcessor;
use Acme\Order\Domain\ValueObject\OrderStatus;
use Acme\Product\Domain\Repository\ProductRepository;
use Tests\TestCase;

/**
 * @author  Iqbal Maulana <iq.bluejack@gmail.com>
 */
class OrderTest extends TestCase
{
    public function testCreateOrder()
    {
        $this->refresh();

        $products = $this->productRepository()->findAll();
        $total = 0;
        $totalQty = 0;
        $orderItems = [];

        foreach ($products as $key => $product) {
            $qty = $key + 1;

            $orderItems[] = [
                'product' => $product->id,
                'qty' => $qty,
            ];

            $total += $product->getPrice() * $qty;
            $totalQty += $qty;
        }

        $order = $this->orderProcessor()->purchase(new class($orderItems) implements PurchaseOrder {
            public function __construct(private array $orderItems)
            {
            }

            public function getOrderItems(): array
            {
                return $this->orderItems;
            }
        });

        $this->assertSame($total, (int) $order->getAmount()->getAmount());
        $this->assertSame($totalQty, $order->getOrderLines()->sum(fn($line) => $line->getQty()));
        $this->assertTrue($order->getStatus()->is(OrderStatus::PENDING));

        $this->orderRepository()->save($order);

        return [
            $total,
            $totalQty,
            $order
        ];
    }

    /**
     * @depends testCreateOrder
     *
     * @param array $data
     */
    public function testUpdateOrder(array $data)
    {
        /**
         * @var Order $order
         */
        [$total, $totalQty, $order] = $data;

        /** @var OrderLine $orderLine */
        $orderLine = $order->getOrderLines()->get(1);

        $total -= (int) $orderLine->getSubTotal()->getAmount();
        $totalQty -= $orderLine->getQty();

        $total += $orderLine->getPrice() * 10;
        $totalQty += 10;

        $order->updateProductQty($orderLine->getProduct()->getId(), 10);

        $this->orderRepository()->save($order);

        $this->assertSame($total, (int) $order->getAmount()->getAmount());
        $this->assertSame($totalQty, $order->getOrderLines()->sum(fn($line) => $line->getQty()));

        return [
            $total,
            $totalQty,
            $order
        ];
    }

    /**
     * @depends testUpdateOrder
     *
     * @param array $data
     */
    public function testDeleteOrder(array $data)
    {
        /**
         * @var Order $order
         */
        [$total, $totalQty, $order] = $data;

        /** @var OrderLine $orderLine */
        $orderLine = $order->getOrderLines()->get(1);

        $total -= (int) $orderLine->getSubTotal()->getAmount();
        $totalQty -= $orderLine->getQty();

        $order->removeProduct($orderLine->getProduct()->getId());

        $this->orderRepository()->save($order);

        $this->assertSame($total, (int) $order->getAmount()->getAmount());
        $this->assertSame($totalQty, $order->getOrderLines()->sum(fn($line) => $line->getQty()));
    }

    private function productRepository(): ProductRepository
    {
        return $this->app->get(ProductRepository::class);
    }

    private function orderRepository(): OrderRepository
    {
        return $this->app->get(OrderRepository::class);
    }

    private function orderProcessor(): PurchaseOrderProcessor
    {
        return $this->app->get(PurchaseOrderProcessor::class);
    }

    private function refresh(): void
    {
        OrderLineMap::truncate();
        OrderMap::truncate();
    }
}
