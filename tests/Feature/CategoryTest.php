<?php

use App\Models\Category;
use App\Models\Expense;

test('it has fillable attributes', function () {
    $category = Category::create([
        'name' => 'Food',
        'description' => 'Groceries and snacks',
        'color' => '#ff0000',
    ]);

    expect($category->name)->toBe('Food')
        ->and($category->description)->toBe('Groceries and snacks')
        ->and($category->color)->toBe('#ff0000');
});

test('it has many expenses', function () {
    $category = Category::factory()->hasExpenses(3)->create();

    expect($category->expenses)->toHaveCount(3)
        ->and($category->expenses->first())->toBeInstanceOf(Expense::class);
});
