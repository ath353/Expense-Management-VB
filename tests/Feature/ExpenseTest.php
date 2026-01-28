<?php

use App\Models\Category;
use App\Models\Expense;
use App\Models\User;

test('it has fillable attributes', function () {
    $user = User::factory()->create();
    $category = Category::factory()->create();

    $expense = Expense::create([
        'user_id' => $user->id,
        'category_id' => $category->id,
        'amount' => 50.25,
        'description' => 'Lunch',
        'expense_date' => now()->format('Y-m-d'),
    ]);

    expect($expense->amount)->toBe('50.25')
        ->and($expense->description)->toBe('Lunch');
});

test('it belongs to a user', function () {
    $expense = Expense::factory()->create();

    expect($expense->user)->toBeInstanceOf(User::class);
});

test('it belongs to a category', function () {
    $expense = Expense::factory()->create();

    expect($expense->category)->toBeInstanceOf(Category::class);
});
