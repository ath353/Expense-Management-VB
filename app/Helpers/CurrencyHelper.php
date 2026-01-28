<?php

namespace App\Helpers;

class CurrencyHelper
{
    /**
     * Format an amount as currency
     *
     * @param int|float $amount The amount to format
     * @param string|null $currency The currency code (uses config default if null)
     * @return string Formatted currency string
     */
    public static function format($amount, $currency = null)
    {
        $currency = $currency ?? config('currency.default');
        $config = config("currency.currencies.{$currency}");

        if (!$config) {
            throw new \InvalidArgumentException("Currency '{$currency}' not found in config.");
        }

        // Format the number
        $formatted = number_format(
            $amount,
            $config['decimal_places'],
            $config['decimal_separator'],
            $config['thousands_separator']
        );

        // Add symbol based on position
        if ($config['position'] === 'before') {
            return $config['symbol'] . $formatted;
        } else {
            return $formatted . ' ' . $config['symbol'];
        }
    }

    /**
     * Get current currency symbol
     *
     * @param string|null $currency
     * @return string
     */
    public static function symbol($currency = null)
    {
        $currency = $currency ?? config('currency.default');
        return config("currency.currencies.{$currency}.symbol");
    }

    /**
     * Get current currency name
     *
     * @param string|null $currency
     * @return string
     */
    public static function name($currency = null)
    {
        $currency = $currency ?? config('currency.default');
        return config("currency.currencies.{$currency}.name");
    }
}
