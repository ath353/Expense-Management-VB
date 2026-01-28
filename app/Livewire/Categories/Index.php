<?php

namespace App\Livewire\Categories;

use App\Livewire\BaseComponent;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;

class Index extends BaseComponent
{
    use WithPagination;

    public function delete(Category $category)
    {
        $category->delete();
        session()->flash('status', __('Danh mục đã được xóa thành công.'));
    }

    public function render()
    {
        return view('livewire.categories.index', [
            'categories' => Auth::user()->categories()->paginate(10),
        ]);
    }
}
