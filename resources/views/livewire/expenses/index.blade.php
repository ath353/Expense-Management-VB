<div class="space-y-8 animate-in fade-in slide-in-from-bottom-4 duration-700">
        <div class="flex items-center justify-between">
            <div>
                <flux:heading size="xl" class="font-display">{{ __('Lịch sử chi tiêu') }}</flux:heading>
                <p class="text-sm text-zinc-500 mt-1">{{ __('Theo dõi và quản lý tất cả các khoản chi tiêu của bạn') }}</p>
            </div>
            <flux:button href="{{ route('expenses.create') }}" icon="plus" variant="primary" class="rounded-xl shadow-lg shadow-primary/20">
                {{ __('Thêm chi tiêu') }}
            </flux:button>
        </div>

        <flux:card class="glass !p-0 !rounded-[2rem] overflow-hidden border-zinc-200/50 dark:border-zinc-800/50">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-zinc-50/50 dark:bg-zinc-800/20 border-b border-zinc-100 dark:border-zinc-800">
                            <th class="py-5 px-6 text-xs font-bold uppercase tracking-wider text-zinc-400">{{ __('Ngày') }}</th>
                            <th class="py-5 px-6 text-xs font-bold uppercase tracking-wider text-zinc-400">{{ __('Danh mục') }}</th>
                            <th class="py-5 px-6 text-xs font-bold uppercase tracking-wider text-zinc-400">{{ __('Số tiền') }}</th>
                            <th class="py-5 px-6 text-xs font-bold uppercase tracking-wider text-zinc-400">{{ __('Mô tả') }}</th>
                            <th class="py-5 px-6 text-xs font-bold uppercase tracking-wider text-zinc-400 text-right">{{ __('Thao tác') }}</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-50 dark:divide-zinc-800/30">
                        @foreach ($expenses as $expense)
                            <tr class="group hover:bg-zinc-50/50 dark:hover:bg-zinc-800/20 transition-all duration-300">
                                <td class="py-5 px-6">
                                    <div class="flex flex-col">
                                        <span class="text-sm font-bold text-zinc-800 dark:text-zinc-200">{{ $expense->expense_date->isToday() ? __('Hôm nay') : ($expense->expense_date->isYesterday() ? __('Hôm qua') : $expense->expense_date->format('d/m')) }}</span>
                                        <span class="text-xs text-zinc-500">{{ $expense->expense_date->format('Y') }}</span>
                                    </div>
                                </td>
                                <td class="py-5 px-6">
                                    <div class="inline-flex items-center gap-2.5 px-3 py-2 rounded-xl" style="background-color: {{ $expense->category->color }}20; border: 2px solid {{ $expense->category->color }};">
                                        <span class="text-[13px] font-bold" style="color: {{ $expense->category->color }};">{{ $expense->category->name }}</span>
                                    </div>
                                </td>
                                <td class="py-5 px-6">
                                    <span class="text-base font-bold text-red-500 tracking-tight">-{{ formatMoney($expense->amount) }}</span>
                                </td>
                                <td class="py-5 px-6 py-4 text-sm text-zinc-500 max-w-xs truncate">
                                    {{ $expense->description ?: '-' }}
                                </td>
                                <td class="py-5 px-6 text-right">
                                    <div class="flex justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                        <flux:button :href="route('expenses.edit', $expense)" icon="pencil" variant="ghost" size="sm" class="rounded-lg hover:bg-white dark:hover:bg-zinc-800 shadow-sm" />
                                        <flux:button wire:click="delete({{ $expense->id }})" :wire:confirm="__('Bạn có chắc chắn muốn xóa chi tiêu này?')" icon="trash" variant="ghost" size="sm" class="rounded-lg hover:bg-red-50 dark:hover:bg-red-900/20 hover:text-red-600 transition-colors" />
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @if($expenses->hasPages())
                <div class="p-6 border-t border-zinc-100 dark:border-zinc-800">
                    {{ $expenses->links() }}
                </div>
            @endif
        </flux:card>
    </div>
