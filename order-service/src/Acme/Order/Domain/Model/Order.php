<?php

declare(strict_types=1);

namespace Acme\Order\Domain\Model;

use Acme\Order\Domain\Collection\OrderLineCollection;
use Acme\Order\Domain\ValueObject\OrderStatus;
use Acme\Shared\Money\MoneyFactory;
use DateTime;
use Illuminate\Support\Str;
use Money\Money;
use Pandawa\Reloquent\Entity\AggregateRoot;

/**
 * @author  Iqbal Maulana <iq.bluejack@gmail.com>
 */
class Order extends AggregateRoot
{
    use PurchasableOrder;

    protected string $id;
    protected string $code;
    protected Money $amount;
    protected OrderStatus $status;
    protected ?array $remark = null;
    protected OrderLineCollection $orderLines;
    protected DateTime $createdAt;

    protected function __construct()
    {
        $this->id = Str::uuid()->toString();
        $this->amount = MoneyFactory::create(0);
        $this->createdAt = new DateTime();
        $this->status = OrderStatus::get(OrderStatus::PENDING);
        $this->orderLines = new OrderLineCollection();
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function getAmount(): Money
    {
        return $this->amount;
    }

    public function getStatus(): OrderStatus
    {
        return $this->status;
    }

    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    public function getOrderLines(): OrderLineCollection
    {
        return $this->orderLines;
    }
}
