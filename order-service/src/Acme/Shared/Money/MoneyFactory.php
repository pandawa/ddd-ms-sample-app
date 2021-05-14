<?php

declare(strict_types=1);

namespace Acme\Shared\Money;

use Money\Currencies;
use Money\Currencies\AggregateCurrencies;
use Money\Currencies\CurrencyList;
use Money\Currencies\ISOCurrencies;
use Money\Currency;
use Money\Formatter\DecimalMoneyFormatter;
use Money\Money;
use Money\Parser\DecimalMoneyParser;

/**
 * @author  Iqbal Maulana <iq.bluejack@gmail.com>
 */
class MoneyFactory
{
    public static function create($amount, string $currency = 'IDR'): Money
    {
        $parser = new DecimalMoneyParser(self::getCurrencies());

        return $parser->parse((string) $amount, new Currency($currency));
    }

    public static function format(Money $money): string
    {
        $formatter = new DecimalMoneyFormatter(self::getCurrencies());

        return $formatter->format($money);
    }

    public static function value(Money $money): float
    {
        return (float) self::format($money);
    }

    private static function getCurrencies(): Currencies
    {
        return new AggregateCurrencies(
            [
                new CurrencyList(['IDR' => 0]),
                new ISOCurrencies(),
            ]
        );
    }
}
