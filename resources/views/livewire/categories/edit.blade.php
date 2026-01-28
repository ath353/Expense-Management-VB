<div class="mx-auto max-w-2xl animate-in fade-in slide-in-from-bottom-4 duration-700">
        <div class="mb-8">
            <flux:heading size="xl" class="font-display">{{ __('Chỉnh sửa danh mục') }}</flux:heading>
            <p class="text-sm text-zinc-500 mt-1">{{ __('Cập nhật thông tin phân loại cho nhóm chi tiêu của bạn') }}</p>
        </div>

        <flux:card class="glass !p-8 !rounded-[2rem] shadow-xl shadow-zinc-900/5">
            <form wire:submit="save" class="space-y-8">
                <flux:input wire:model="name" :label="__('Tên danh mục')" :placeholder="__('Ví dụ: Ăn uống, Di chuyển')" class="!bg-zinc-50/50 dark:!bg-zinc-800/20" />
                
                <flux:textarea wire:model="description" :label="__('Mô tả')" :placeholder="__('Mô tả tùy chọn...')" class="!bg-zinc-50/50 dark:!bg-zinc-800/20" />
                
                <flux:input wire:model="color" type="color" :label="__('Màu sắc nhận diện')" class="!h-14 !p-1 !bg-zinc-50/50 dark:!bg-zinc-800/20 rounded-xl" />

                <div class="flex justify-end gap-3 pt-6">
                    <flux:button :href="route('categories.index')" variant="ghost" class="rounded-xl">{{ __('Hủy') }}</flux:button>
                    <flux:button type="submit" variant="primary" class="rounded-xl px-8 shadow-lg shadow-primary/20">{{ __('Cập nhật danh mục') }}</flux:button>
                </div>
            </form>
        </flux:card>
    </div>
