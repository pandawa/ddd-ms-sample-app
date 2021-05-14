<?php

declare(strict_types=1);

namespace Acme\Inventory\Domain\Model;

use Acme\Product\Domain\Model\Product;
use Pandawa\Reloquent\Entity\Entity;

/**
 * @author  Iqbal Maulana <iq.bluejack@gmail.com>
 */
class Inventory extends Entity
{
    protected string $id;
    protected Product $product;
    protected int $stock;

    public function __construct()
    {
        $this->stock = 1;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getProduct(): Product
    {
        return $this->product;
    }

    public function setProduct(Product $product): void
    {
        $this->product = $product;
    }

    public function getStock(): int
    {
        return $this->stock;
    }

    public function setStock(int $stock): void
    {
        $this->stock = $stock;
    }
}
