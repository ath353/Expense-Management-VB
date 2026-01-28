@php
    $user = Auth::user();
    $totalExpenses = $user->expenses()->sum('amount');
    $expensesThisMonth = $user->expenses()->whereMonth('expense_date', now()->month)->whereYear('expense_date', now()->year)->sum('amount');
    
    $daysInMonthPassed = now()->day;
    $avgDailyExpense = $expensesThisMonth / max(1, $daysInMonthPassed);
    
    $recentExpenses = $user->expenses()->with('category')->latest('expense_date')->take(5)->get();

    $expensesByCategory = $user->expenses()
        ->selectRaw('category_id, sum(amount) as total')
        ->groupBy('category_id')
        ->with('category')
        ->get();
    
    $chartLabels = $expensesByCategory->pluck('category.name')->toArray();
    $chartData = $expensesByCategory->pluck('total')->toArray();
    $chartColors = $expensesByCategory->pluck('category.color')->toArray();
@endphp

<x-layouts.app title="EXM">
    <div class="space-y-6">
        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <flux:card class="p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-zinc-500 dark:text-zinc-400">{{ __('Tổng chi tiêu') }}</p>
                        <p class="text-2xl font-bold mt-1">{{ formatMoney($totalExpenses) }}</p>
                    </div>
                    <div class="w-12 h-12 rounded-xl bg-blue-100 dark:bg-blue-900/20 flex items-center justify-center">
                        <flux:icon.banknotes class="w-6 h-6 text-blue-600 dark:text-blue-400" />
                    </div>
                </div>
            </flux:card>

            <flux:card class="p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-zinc-500 dark:text-zinc-400">{{ __('Chi tiêu tháng này') }}</p>
                        <p class="text-2xl font-bold mt-1">{{ formatMoney($expensesThisMonth) }}</p>
                    </div>
                    <div class="w-12 h-12 rounded-xl bg-purple-100 dark:bg-purple-900/20 flex items-center justify-center">
                        <flux:icon.calendar class="w-6 h-6 text-purple-600 dark:text-purple-400" />
                    </div>
                </div>
            </flux:card>

            <flux:card class="p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-zinc-500 dark:text-zinc-400">{{ __('Trung bình/ngày') }}</p>
                        <p class="text-2xl font-bold mt-1">{{ formatMoney($avgDailyExpense) }}</p>
                    </div>
                    <div class="w-12 h-12 rounded-xl bg-green-100 dark:bg-green-900/20 flex items-center justify-center">
                        <flux:icon.chart-bar class="w-6 h-6 text-green-600 dark:text-green-400" />
                    </div>
                </div>
            </flux:card>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Chart -->
            <div class="lg:col-span-1">
                <flux:card class="p-6">
                    <flux:heading size="lg" class="mb-4">{{ __('Chi tiêu theo danh mục') }}</flux:heading>
                    
                    <div class="flex items-center justify-center min-h-[250px]">
                        @if(count($chartData) > 0)
                            <canvas id="expenseChart" class="max-w-[200px] max-h-[200px]"></canvas>
                        @else
                            <div class="text-center space-y-2">
                                <flux:icon.chart-pie class="w-12 h-12 mx-auto text-zinc-300 dark:text-zinc-700" />
                                <p class="text-sm text-zinc-500">{{ __('Chưa có dữ liệu') }}</p>
                            </div>
                        @endif
                    </div>

                    @if(count($chartData) > 0)
                        <div class="mt-6 space-y-2">
                            @foreach($expensesByCategory->take(3) as $item)
                                <div class="flex items-center justify-between text-sm">
                                    <div class="flex items-center gap-2">
                                        <div class="w-3 h-3 rounded-full" style="background-color: {{ $item->category->color }}"></div>
                                        <span class="text-zinc-600 dark:text-zinc-400">{{ $item->category->name }}</span>
                                    </div>
                                    <span class="font-semibold">{{ round(($item->total / max(1, $totalExpenses)) * 100, 1) }}%</span>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </flux:card>
            </div>

            <!-- Recent Transactions -->
            <div class="lg:col-span-2">
                <flux:card class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <flux:heading size="lg">{{ __('Giao dịch gần đây') }}</flux:heading>
                        <flux:button :href="route('expenses.index')" variant="ghost" size="sm">{{ __('Xem tất cả') }}</flux:button>
                    </div>

                    @if($recentExpenses->count() > 0)
                        <div class="space-y-3">
                            @foreach($recentExpenses as $expense)
                                <div class="flex items-center justify-between p-3 rounded-lg hover:bg-zinc-50 dark:hover:bg-zinc-800/50 transition-colors">
                                    <div class="flex items-center gap-3">
                                        <div class="px-3 py-2 rounded-xl" style="background-color: {{ $expense->category->color }}20; border: 2px solid {{ $expense->category->color }};">
                                            <span class="text-xs font-bold" style="color: {{ $expense->category->color }};">{{ $expense->category->name }}</span>
                                        </div>
                                        <div>
                                            <p class="text-xs text-zinc-500">{{ $expense->expense_date->format('d/m/Y') }}</p>
                                        </div>
                                    </div>
                                    <span class="font-bold text-red-500">-{{ formatMoney($expense->amount) }}</span>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8">
                            <flux:icon.credit-card class="w-12 h-12 mx-auto text-zinc-300 dark:text-zinc-700 mb-2" />
                            <p class="text-sm text-zinc-500">{{ __('Chưa có giao dịch nào') }}</p>
                        </div>
                    @endif
                </flux:card>
            </div>
        </div>
    </div>

    @if(count($chartData) > 0)
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('expenseChart').getContext('2d');
            new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: @js($chartLabels),
                    datasets: [{
                        data: @js($chartData),
                        backgroundColor: @js($chartColors),
                        borderWidth: 0,
                        hoverOffset: 10
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '70%',
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    const amount = context.parsed;
                                    const currency = '{{ config("currency.default") }}';
                                    const config = @js(config('currency.currencies'));
                                    const currencyConfig = config[currency];
                                    
                                    const formatted = new Intl.NumberFormat('vi-VN', {
                                        minimumFractionDigits: currencyConfig.decimal_places,
                                        maximumFractionDigits: currencyConfig.decimal_places,
                                    }).format(amount);
                                    
                                    const symbol = currencyConfig.symbol;
                                    const displayValue = currencyConfig.position === 'before' 
                                        ? symbol + formatted 
                                        : formatted + ' ' + symbol;
                                    
                                    return context.label + ': ' + displayValue;
                                }
                            }
                        }
                    }
                }
            });
        });
    </script>
    @endif
</x-layouts.app>
