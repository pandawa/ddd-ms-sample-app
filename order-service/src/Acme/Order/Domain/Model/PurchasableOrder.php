<?php

declare(strict_types=1);

namespace Acme\Order\Domain\Model;

use Acme\Order\Domain\DTO\PurchasedItem;
use Acme\Order\Domain\Event\OrderLineDeleted;
use Acme\Order\Domain\Event\OrderPurchased;
use Acme\Order\Domain\Event\OrderStateChanged;
use Acme\Order\Domain\ValueObject\OrderStatus;
use Acme\Product\Domain\Model\Product;

/**
 * @author  Iqbal Maulana <iq.bluejack@gmail.com>
 *
 * @mixin Order
 */
trait PurchasableOrder
{
    /**
     * @param string          $receipt
     * @param PurchasedItem[] $orderItems
     *
     * @return static
     */
    public static function create(string $receipt, array $orderItems): static
    {
        $order = new static();
        $order->code = $receipt;

        foreach ($orderItems as $orderItem) {
            $order->addProduct($orderItem->getProduct(), $orderItem->getQty());
        }

        return $order->addEvent(OrderPurchased::createFromOrder($order));
    }

    public function finalize(): static
    {
        $this->status = OrderStatus::get(OrderStatus::CREATED);

        return $this->addEvent(new OrderStateChanged($this->id, $this->status));
    }

    public function cancel(array $remark = []): static
    {
        $this->status = OrderStatus::get(OrderStatus::CANCELED);
        $this->remark = $remark;

        return $this->addEvent(new OrderStateChanged($this->id, $this->status));
    }

    public function addProduct(Product $product, int $qty): void
    {
        $orderLine = OrderLine::create($product, $qty);

        $this->orderLines->add($orderLine);
        $this->amount = $this->amount->add($orderLine->getSubTotal());
    }

    public function updateProductQty(string $product, int $qty): void
    {
        $orderLine = $this->getOrderLines()->findByProductIdOrFail($product);
        $this->amount = $this->amount->subtract($orderLine->getSubTotal());

        $orderLine->setQty($qty);
        $this->amount = $this->amount->add($orderLine->getSubTotal());
    }

    public function removeProduct(string $product): void
    {
        $orderLine = $this->getOrderLines()->findByProductIdOrFail($product);

        $this->orderLines->remove($orderLine);

        $this->amount = $this->amount->subtract($orderLine->getSubTotal());

        $this->addEvent(new OrderLineDeleted($this->getId(), $orderLine->getId()));
    }
}
