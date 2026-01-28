<?php

namespace App\Livewire\Expenses;

use App\Livewire\BaseComponent;
use App\Models\Expense;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;

class Index extends BaseComponent
{
    use WithPagination;

    public function delete(Expense $expense)
    {
        if ($expense->user_id === Auth::id()) {
            $expense->delete();
            session()->flash('status', __('Chi tiêu đã được xóa thành công.'));
        }
    }

    public function render()
    {
        return view('livewire.expenses.index', [
            'expenses' => Auth::user()->expenses()->with('category')->latest('expense_date')->paginate(10),
        ]);
    }
}
