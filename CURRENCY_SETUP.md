# Currency Formatting System

## Overview
This system provides centralized currency formatting for the entire application. Change currency in ONE place only.

## Files Created

### 1. **config/currency.php** - Central Configuration
Contains all currency definitions with their symbols, decimal places, and formatting rules.

```php
'default' => env('APP_CURRENCY', 'VND'),

'currencies' => [
    'VND' => [
        'symbol' => '₫',
        'decimal_places' => 0,
        'thousands_separator' => '.',
        'decimal_separator' => ',',
        'position' => 'after',
    ],
    'USD' => [...],
    'JPY' => [...],
    'EUR' => [...],
]
```

### 2. **app/Helpers/CurrencyHelper.php** - Helper Class
Provides static methods for currency formatting:
- `CurrencyHelper::format($amount, $currency)` - Format amount as currency
- `CurrencyHelper::symbol($currency)` - Get currency symbol
- `CurrencyHelper::name($currency)` - Get currency name

### 3. **app/Helpers/helpers.php** - Global Functions
Blade-friendly helper functions:
- `formatMoney($amount, $currency)` - Format in Blade templates
- `currencySymbol($currency)` - Get symbol in Blade
- `currencyName($currency)` - Get name in Blade

## Usage

### In Blade Templates
```blade
<!-- Format amount -->
{{ formatMoney($expense->amount) }}

<!-- Get symbol -->
{{ currencySymbol() }}

<!-- Get currency name -->
{{ currencyName() }}
```

### In PHP/Livewire
```php
use App\Helpers\CurrencyHelper;

$formatted = CurrencyHelper::format(480000);
$symbol = CurrencyHelper::symbol();
```

## How to Change Currency

### Option 1: Update config/currency.php
Change the `'default'` value:
```php
'default' => 'USD', // Change from 'VND' to 'USD'
```

### Option 2: Use Environment Variable
Add to `.env`:
```
APP_CURRENCY=USD
```

## Examples

### Vietnamese Dong (VND)
```
Input: 480000
Output: 480.000 ₫
```

### US Dollar (USD)
```
Input: 480000
Output: $480000.00
```

### Japanese Yen (JPY)
```
Input: 480000
Output: ¥480,000
```

## Adding New Currency

1. Open `config/currency.php`
2. Add new currency to `'currencies'` array:
```php
'GBP' => [
    'symbol' => '£',
    'name' => 'British Pound',
    'decimal_places' => 2,
    'thousands_separator' => ',',
    'decimal_separator' => '.',
    'position' => 'before',
],
```
3. Set as default if needed

## Files Updated

- `resources/views/dashboard.blade.php` - Uses `formatMoney()` for all amounts
- `resources/views/livewire/expenses/index.blade.php` - Uses `formatMoney()` for expense amounts
- `composer.json` - Autoloads helpers.php

## Database
No database changes needed. Amounts are stored as integers (480000), formatting is applied only for display.
