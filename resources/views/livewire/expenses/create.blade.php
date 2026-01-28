<div class="mx-auto max-w-2xl animate-in fade-in slide-in-from-bottom-4 duration-700">
        <div class="mb-8">
            <flux:heading size="xl" class="font-display">{{ __('Thêm chi tiêu mới') }}</flux:heading>
            <p class="text-sm text-zinc-500 mt-1">{{ __('Ghi lại khoản chi vừa phát sinh để quản lý ngân sách chính xác') }}</p>
        </div>

        <flux:card class="glass !p-8 !rounded-[2rem] shadow-xl shadow-zinc-900/5">
            <form wire:submit="save" class="space-y-8">
                <div>
                    <flux:select wire:model.live="category_id" :label="__('Danh mục')" :placeholder="__('Chọn một danh mục')" class="!bg-zinc-50/50 dark:!bg-zinc-800/20">
                        <flux:select.option value="">{{ __('-- Chọn danh mục --') }}</flux:select.option>
                        @foreach($categories as $category)
                            <flux:select.option value="{{ $category->id }}">{{ $category->name }}</flux:select.option>
                        @endforeach
                    </flux:select>
                    @error('category_id')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <flux:input wire:model.live="amount" type="number" step="1" :label="__('Số tiền giao dịch')" placeholder="0" class="!bg-zinc-50/50 dark:!bg-zinc-800/20">
                        <x-slot name="append">
                            <span class="text-zinc-400 font-bold px-3">{{ currencySymbol() }}</span>
                        </x-slot>
                    </flux:input>
                    @error('amount')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <flux:input wire:model.live="expense_date" type="date" :label="__('Ngày giao dịch')" class="!bg-zinc-50/50 dark:!bg-zinc-800/20" />
                    @error('expense_date')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <flux:textarea wire:model.live="description" :label="__('Ghi chú chi hoạt động')" :placeholder="__('Chi tiêu này cho việc gì?')" class="!bg-zinc-50/50 dark:!bg-zinc-800/20" />
                    @error('description')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end gap-3 pt-6">
                    <flux:button :href="route('expenses.index')" variant="ghost" class="rounded-xl">{{ __('Hủy') }}</flux:button>
                    <flux:button type="submit" variant="primary" class="rounded-xl px-8 shadow-lg shadow-primary/20">{{ __('Lưu chi tiêu') }}</flux:button>
                </div>
            </form>
        </flux:card>
    </div>
