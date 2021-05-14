<?php

declare(strict_types=1);

namespace Acme\Shared\Enum;

use Illuminate\Contracts\Database\Eloquent\Castable;
use Illuminate\Contracts\Database\Eloquent\SerializesCastableAttributes;
use MabeEnum\Enum as BaseEnum;
use MabeEnum\EnumSerializableTrait;

/**
 * @author  Iqbal Maulana <iq.bluejack@gmail.com>
 */
abstract class Enum extends BaseEnum implements Castable, SerializesCastableAttributes
{
    use EnumSerializableTrait;

    public static function castUsing(array $arguments)
    {
        return EnumCast::class;
    }

    public function serialize($model, string $key, $value, array $attributes)
    {
        return $value instanceof BaseEnum ? $value->getValue() : $value;
    }
}
