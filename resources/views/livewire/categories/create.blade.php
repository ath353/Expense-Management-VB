<div class="mx-auto max-w-2xl animate-in fade-in slide-in-from-bottom-4 duration-700">
        <div class="mb-8">
            <flux:heading size="xl" class="font-display">{{ __('Tạo danh mục mới') }}</flux:heading>
            <p class="text-sm text-zinc-500 mt-1">{{ __('Thiết lập một nhóm chi tiêu mới để bắt đầu theo dõi tài chính') }}</p>
        </div>

        <flux:card class="glass !p-8 !rounded-[2rem] shadow-xl shadow-zinc-900/5">
            <form wire:submit="save" class="space-y-8">
                <flux:input wire:model="name" :label="__('Tên danh mục')" :placeholder="__('Ví dụ: Ăn uống, Di chuyển')" class="!text-white !placeholder-zinc-400" style="background-color: rgba(39, 39, 42, 0.95);" />
                
                <flux:textarea wire:model="description" :label="__('Mô tả')" :placeholder="__('Mô tả tùy chọn...')" class="!text-white !placeholder-zinc-400" style="background-color: rgba(39, 39, 42, 0.95);" />
                
                <div>
                    <flux:label :label="__('Màu sắc nhận diện')" />
                    <div class="mt-3 space-y-4">
                        <!-- Preset Colors -->
                        <div class="flex flex-wrap gap-3">
                            @foreach(['#ef4444', '#f97316', '#eab308', '#22c55e', '#06b6d4', '#3b82f6', '#8b5cf6', '#ec4899', '#6b7280'] as $presetColor)
                                <button
                                    type="button"
                                    wire:click="$set('color', '{{ $presetColor }}')"
                                    class="w-10 h-10 rounded-lg transition-all duration-200 {{ $color === $presetColor ? 'ring-2 ring-offset-2 ring-offset-zinc-900 ring-white scale-110' : 'hover:scale-105' }}"
                                    style="background-color: {{ $presetColor }};"
                                    title="{{ $presetColor }}"
                                />
                            @endforeach
                        </div>
                        
                        <!-- Custom Color Picker -->
                        <div class="flex items-center gap-3 pt-2">
                            <input 
                                type="color" 
                                wire:model="color" 
                                class="w-12 h-12 rounded-lg cursor-pointer border border-zinc-700 hover:border-zinc-600"
                            />
                            <div class="flex-1">
                                <input 
                                    type="text" 
                                    wire:model="color" 
                                    placeholder="#000000"
                                    class="w-full px-3 py-2 bg-zinc-800/50 border border-zinc-700 rounded-lg text-sm font-mono text-zinc-300 placeholder-zinc-600 focus:outline-none focus:border-zinc-500"
                                />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex justify-end gap-3 pt-6">
                    <flux:button :href="route('categories.index')" variant="ghost" class="rounded-xl">{{ __('Hủy') }}</flux:button>
                    <flux:button type="submit" variant="primary" class="rounded-xl px-8 shadow-lg shadow-primary/20">{{ __('Tạo danh mục') }}</flux:button>
                </div>
            </form>
        </flux:card>
    </div>
