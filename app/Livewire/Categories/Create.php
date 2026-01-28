<?php

namespace App\Livewire\Categories;

use App\Livewire\BaseComponent;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class Create extends BaseComponent
{
    public string $name = '';
    public string $description = '';
    public string $color = '#3b82f6';

    protected $rules = [
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'color' => 'nullable|string|max:7',
    ];

    public function save()
    {
        $this->validate();

        Auth::user()->categories()->create([
            'name' => $this->name,
            'description' => $this->description,
            'color' => $this->color,
        ]);

        session()->flash('status', __('Danh mục đã được tạo thành công.'));

        return redirect()->route('categories.index');
    }

    public function render()
    {
        return view('livewire.categories.create');
    }
}
