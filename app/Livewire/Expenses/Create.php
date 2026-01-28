<?php

namespace App\Livewire\Expenses;

use App\Livewire\BaseComponent;
use App\Models\Category;
use App\Models\Expense;
use Illuminate\Support\Facades\Auth;

class Create extends BaseComponent
{
    public $category_id = '';
    public $amount = '';
    public $description = '';
    public $expense_date;

    #[\Livewire\Attributes\Validate]
    public function mount()
    {
        $this->expense_date = now()->format('Y-m-d');
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

        Auth::user()->expenses()->create([
            'category_id' => (int)$validated['category_id'],
            'amount' => $amount,
            'description' => $validated['description'],
            'expense_date' => $validated['expense_date'],
        ]);

        session()->flash('status', __('Chi tiêu đã được thêm thành công.'));

        return redirect()->route('expenses.index');
    }

    public function render()
    {
        return view('livewire.expenses.create', [
            'categories' => Auth::user()->categories,
        ]);
    }
}
