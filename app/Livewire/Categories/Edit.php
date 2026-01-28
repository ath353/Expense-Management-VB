<?php

namespace App\Livewire\Categories;

use App\Livewire\BaseComponent;
use App\Models\Category;

class Edit extends BaseComponent
{
    public Category $category;
    public string $name = '';
    public string $description = '';
    public string $color = '';

    public function mount(Category $category)
    {
        $this->category = $category;
        $this->name = $category->name;
        $this->description = $category->description ?? '';
        $this->color = $category->color ?? '#3b82f6';
    }

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'color' => 'nullable|string|max:7',
        ];
    }

    public function save()
    {
        $this->validate();

        $this->category->update([
            'name' => $this->name,
            'description' => $this->description,
            'color' => $this->color,
        ]);

        session()->flash('status', __('Danh mục đã được cập nhật thành công.'));

        return redirect()->route('categories.index');
    }

    public function render()
    {
        return view('livewire.categories.edit');
    }
}
