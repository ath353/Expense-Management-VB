<x-layouts::auth>
    <div class="flex flex-col gap-6">
        <x-auth-header :title="__('Đăng nhập vào tài khoản')" />

        <!-- Session Status -->
        <x-auth-session-status class="text-center" :status="session('status')" />

        <form method="POST" action="{{ route('login.store') }}" class="flex flex-col gap-6" id="login-form" autocomplete="off">
            @csrf

            <!-- Email Address -->
            <flux:input
                name="email"
                :label="__('Địa chỉ email')"
                :value="old('email')"
                type="email"
                required
                autofocus
                autocomplete="off"
                placeholder="email@example.com"
            />

            <!-- Password -->
            <flux:input
                name="password"
                :label="__('Mật khẩu')"
                type="password"
                required
                autocomplete="off"
                :placeholder="__('Mật khẩu')"
                viewable
            />

            <!-- Remember Me -->
            <flux:checkbox name="remember" :label="__('Ghi nhớ đăng nhập')" :checked="old('remember')" />

            <div class="flex items-center justify-end">
                <flux:button variant="primary" type="submit" class="w-full" data-test="login-button">
                    {{ __('Đăng nhập') }}
                </flux:button>
            </div>
        </form>

        @if (Route::has('password.request'))
            <div class="text-center text-sm">
                <flux:link :href="route('password.request')" wire:navigate>
                    {{ __('Quên mật khẩu?') }}
                </flux:link>
            </div>
        @endif

        @if (Route::has('register'))
            <div class="space-x-1 text-sm text-center rtl:space-x-reverse text-zinc-600 dark:text-zinc-400">
                <span>{{ __('Chưa có tài khoản?') }}</span>
                <flux:link :href="route('register')" wire:navigate>{{ __('Đăng ký ngay') }}</flux:link>
            </div>
        @endif
    </div>

    <script>
        // Clear form when page is loaded from bfcache
        window.addEventListener('pageshow', function(event) {
            if (event.persisted) {
                // Page loaded from cache, clear the form
                const form = document.getElementById('login-form');
                if (form) {
                    form.reset();
                    // Force clear all input values including autofilled ones
                    setTimeout(() => {
                        const inputs = form.querySelectorAll('input');
                        inputs.forEach(input => {
                            input.value = '';
                            input.setAttribute('value', '');
                        });
                    }, 0);
                }
            }
        });

        // Clear form on page load (additional safety)
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('login-form');
            if (form && window.performance && window.performance.navigation.type === 2) {
                // Type 2 means back/forward navigation
                form.reset();
                const inputs = form.querySelectorAll('input');
                inputs.forEach(input => {
                    input.value = '';
                    input.setAttribute('value', '');
                });
            }
        });
    </script>
</x-layouts::auth>
