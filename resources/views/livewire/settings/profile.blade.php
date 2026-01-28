<section class="w-full animate-in fade-in slide-in-from-bottom-4 duration-700">
    @include('partials.settings-heading')

    <flux:heading class="sr-only">{{ __('Cài đặt hồ sơ') }}</flux:heading>

    <div class="mt-8">
        <flux:card class="glass !p-8 !rounded-[2rem] shadow-xl shadow-zinc-900/5">
            <div class="mb-8">
                <flux:heading level="2" size="lg" class="font-display">{{ __('Hồ sơ cá nhân') }}</flux:heading>
                <p class="text-sm text-zinc-500 mt-1">{{ __('Cập nhật thông tin nhận diện và địa chỉ liên lạc của bạn') }}</p>
            </div>

            <form wire:submit="updateProfileInformation" class="space-y-8">
                <flux:input wire:model="name" :label="__('Họ và tên')" type="text" required autofocus autocomplete="name" class="!bg-zinc-50/50 dark:!bg-zinc-800/20" />

                <div class="space-y-4">
                    <flux:input wire:model="email" :label="__('Địa chỉ Email')" type="email" required autocomplete="email" class="!bg-zinc-50/50 dark:!bg-zinc-800/20" />

                    @if ($this->hasUnverifiedEmail)
                        <div class="p-4 rounded-2xl bg-orange-50 dark:bg-orange-950/20 border border-orange-100 dark:border-orange-900/30">
                            <flux:text class="text-sm text-orange-700 dark:text-orange-400">
                                {{ __('Địa chỉ email của bạn chưa được xác thực.') }}

                                <flux:link class="font-bold underline cursor-pointer ml-1" wire:click.prevent="resendVerificationNotification">
                                    {{ __('Gửi lại email xác thực.') }}
                                </flux:link>
                            </flux:text>

                            @if (session('status') === 'verification-link-sent')
                                <flux:text class="mt-2 text-xs font-bold text-green-600 dark:text-green-400">
                                    {{ __('Một liên kết xác thực mới đã được gửi đến địa chỉ email của bạn.') }}
                                </flux:text>
                            @endif
                        </div>
                    @endif
                </div>

                <div class="flex items-center gap-4 pt-6">
                    <flux:button variant="primary" type="submit" class="rounded-xl px-8 shadow-lg shadow-primary/20">{{ __('Lưu thay đổi') }}</flux:button>

                    <x-action-message class="text-green-600 dark:text-green-400 font-bold" on="profile-updated">
                        {{ __('Đã cập nhật.') }}
                    </x-action-message>
                </div>
            </form>
        </flux:card>

        @if ($this->showDeleteUser)
            <div class="mt-8">
                <livewire:settings.delete-user-form />
            </div>
        @endif
    </div>
</section>
