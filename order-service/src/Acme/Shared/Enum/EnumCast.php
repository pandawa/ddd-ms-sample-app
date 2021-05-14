<?php

declare(strict_types=1);

namespace Acme\Shared\Enum;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Contracts\Database\Eloquent\SerializesCastableAttributes;
use MabeEnum\Enum;

/**
 * @author  Iqbal Maulana <iq.bluejack@gmail.com>
 */
class EnumCast implements CastsAttributes, SerializesCastableAttributes
{
    public function get($model, string $key, $value, array $attributes)
    {
        if (null === $value) {
            return null;
        }

        if ($value instanceof Enum) {
            return $value;
        }

        $castClass = $model->getCasts()[$key];

        return $castClass::get($value);
    }

    public function set($model, string $key, $value, array $attributes)
    {
        return $value instanceof Enum ? $value->getValue() : $value;
    }

    public function serialize($model, string $key, $value, array $attributes)
    {
        return $value instanceof Enum ? $value->getValue() : $value;
    }
}
