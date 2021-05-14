<?php

declare(strict_types=1);

namespace Acme\Shared\Money;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

/**
 * @author  Iqbal Maulana <iq.bluejack@gmail.com>
 */
class MoneyCast implements CastsAttributes
{
    public function get($model, string $key, $value, array $attributes)
    {
        $amountField = $key.'_amount';
        $currencyField = $key.'_currency';

        return MoneyFactory::create(
            $model->{$amountField} ?? 0,
            $model->{$currencyField} ?? 'IDR'
        );
    }

    public function set($model, string $key, $value, array $attributes)
    {
        $amountField = $key.'_amount';
        $currencyField = $key.'_currency';

        return [
            $amountField   => $value->getAmount(),
            $currencyField => $value->getCurrency()->getCode(),
        ];
    }
}
