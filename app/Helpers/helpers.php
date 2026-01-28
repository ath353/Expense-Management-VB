<?php

use App\Helpers\CurrencyHelper;

if (!function_exists('formatMoney')) {
    /**
     * Format an amount as currency
     *
     * @param int|float $amount
     * @param string|null $currency
     * @return string
     */
    function formatMoney($amount, $currency = null)
    {
        return CurrencyHelper::format($amount, $currency);
    }
}

if (!function_exists('currencySymbol')) {
    /**
     * Get currency symbol
     *
     * @param string|null $currency
     * @return string
     */
    function currencySymbol($currency = null)
    {
        return CurrencyHelper::symbol($currency);
    }
}

if (!function_exists('currencyName')) {
    /**
     * Get currency name
     *
     * @param string|null $currency
     * @return string
     */
    function currencyName($currency = null)
    {
        return CurrencyHelper::name($currency);
    }
}
