<?php

declare(strict_types=1);

namespace Acme\Inventory\Application\DTO;

use Exception;

/**
 * @author  Iqbal Maulana <iq.bluejack@gmail.com>
 */
class ExceptionBag
{
    public function __construct(protected string $type, protected mixed $code, protected string $message)
    {
    }

    public static function createFromException(Exception $e): static
    {
        return new static(
            class_basename($e),
            $e->getCode(),
            $e->getMessage()
        );
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getCode(): mixed
    {
        return $this->code;
    }

    public function getMessage(): string
    {
        return $this->message;
    }
}
