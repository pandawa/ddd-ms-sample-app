<?php

declare(strict_types=1);

namespace Acme\Common\Domain\Model;

use Illuminate\Support\Str;
use Pandawa\Reloquent\Entity\Entity;

/**
 * @author  Iqbal Maulana <iq.bluejack@gmail.com>
 */
class Category extends Entity
{
    protected string $id;
    protected string $name;

    public function __construct()
    {
        $this->id = Str::uuid()->toString();
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }
}
