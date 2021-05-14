<?php

declare(strict_types=1);

namespace Acme\Order\Domain\Model;

use Acme\Product\Domain\Model\Product;
use Acme\Shared\Money\MoneyFactory;
use Illuminate\Support\Str;
use Money\Money;
use Pandawa\Reloquent\Entity\Entity;

/**
 * @author  Iqbal Maulana <iq.bluejack@gmail.com>
 */
class OrderLine extends Entity
{
    protected string $id;
    protected Product $product;
    protected int $price;
    protected int $qty;

    public function __construct()
    {
        $this->id = Str::uuid()->toString();
    }

    public static function create(Product $product, int $qty): static
    {
        $orderLine = new static();
        $orderLine->setProduct($product);
        $orderLine->setQty($qty);

        return $orderLine;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function setProduct(Product $product): void
    {
        $this->product = $product;
        $this->price = $product->getPrice();
    }

    public function getProduct(): Product
    {
        return $this->product;
    }

    public function getPrice(): int
    {
        return $this->price ?? 0;
    }

    public function setQty(int $qty): void
    {
        $this->qty = $qty;
    }

    public function getQty(): int
    {
        return $this->qty;
    }

    public function getSubTotal(): Money
    {
        return MoneyFactory::create($this->price * $this->qty);
    }
}
