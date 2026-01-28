<section class="w-full animate-in fade-in slide-in-from-bottom-4 duration-700">
    @include('partials.settings-heading')

    <flux:heading class="sr-only">{{ __('Cài đặt mật khẩu') }}</flux:heading>

    <div class="mt-8">
        <flux:card class="glass !p-8 !rounded-[2rem] shadow-xl shadow-zinc-900/5">
            <div class="mb-8">
                <flux:heading level="2" size="lg" class="font-display">{{ __('Đổi mật khẩu') }}</flux:heading>
                <p class="text-sm text-zinc-500 mt-1">{{ __('Đảm bảo tài khoản của bạn đang sử dụng mật khẩu dài, ngẫu nhiên để giữ an toàn') }}</p>
            </div>

            <form method="POST" wire:submit="updatePassword" class="space-y-8">
                <flux:input
                    wire:model="current_password"
                    :label="__('Mật khẩu hiện tại')"
                    type="password"
                    required
                    autocomplete="current-password"
                    class="!bg-zinc-50/50 dark:!bg-zinc-800/20"
                />
                <flux:input
                    wire:model="password"
                    :label="__('Mật khẩu mới')"
                    type="password"
                    required
                    autocomplete="new-password"
                    class="!bg-zinc-50/50 dark:!bg-zinc-800/20"
                />
                <flux:input
                    wire:model="password_confirmation"
                    :label="__('Xác nhận mật khẩu mới')"
                    type="password"
                    required
                    autocomplete="new-password"
                    class="!bg-zinc-50/50 dark:!bg-zinc-800/20"
                />

                <div class="flex items-center gap-4 pt-6">
                    <flux:button variant="primary" type="submit" class="rounded-xl px-8 shadow-lg shadow-primary/20">{{ __('Cập nhật mật khẩu') }}</flux:button>

                    <x-action-message class="text-green-600 dark:text-green-400 font-bold" on="password-updated">
                        {{ __('Đã thay đổi.') }}
                    </x-action-message>
                </div>
            </form>
        </flux:card>
    </div>
</section>
