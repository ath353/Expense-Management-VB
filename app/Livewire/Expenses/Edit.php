<?php

namespace App\Livewire\Expenses;

use App\Livewire\BaseComponent;
use App\Models\Category;
use App\Models\Expense;
use Illuminate\Support\Facades\Auth;

class Edit extends BaseComponent
{
    public Expense $expense;
    public $category_id;
    public $amount;
    public $description;
    public $expense_date;

    public function mount(Expense $expense)
    {
        if ($expense->user_id !== Auth::id()) {
            return redirect()->route('expenses.index');
        }

        $this->expense = $expense;
        $this->category_id = $expense->category_id;
        $this->amount = $expense->amount;
        $this->description = $expense->description;
        $this->expense_date = $expense->expense_date->format('Y-m-d');
    }

    protected function rules()
    {
        return [
            'category_id' => 'required|integer|exists:categories,id',
            'amount' => 'required|regex:/^[0-9.,]+$/|min:1',
            'description' => 'nullable|string|max:500',
            'expense_date' => 'required|date',
        ];
    }

    protected function messages()
    {
        return [
            'category_id.required' => __('Trường danh mục không được để trống.'),
            'category_id.exists' => __('Danh mục không hợp lệ.'),
            'amount.required' => __('Trường số tiền không được để trống.'),
            'amount.min' => __('Số tiền phải lớn hơn 0.'),
        ];
    }

    public function save()
    {
        $validated = $this->validate();

        // Parse amount: remove dots and commas, convert to integer
        $amount = (int)str_replace(['.', ','], '', $validated['amount']);

        $this->expense->update([
            'category_id' => (int)$validated['category_id'],
            'amount' => $amount,
            'description' => $validated['description'],
            'expense_date' => $validated['expense_date'],
        ]);

        session()->flash('status', __('Chi tiêu đã được cập nhật thành công.'));

        return redirect()->route('expenses.index');
    }

    public function render()
    {
        return view('livewire.expenses.edit', [
            'categories' => Auth::user()->categories,
        ]);
    }
}
