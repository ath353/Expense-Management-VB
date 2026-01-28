<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="bg-black">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'EXM') }}</title>
    <link rel="icon" href="/favicon.png" type="image/png">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        html, body {
            background: #000 !important;
            color: #fff;
        }
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
        @keyframes pulse-glow {
            0%, 100% { opacity: 0.5; }
            50% { opacity: 0.8; }
        }
        .animate-float {
            animation: float 6s ease-in-out infinite;
        }
        .animate-pulse-glow {
            animation: pulse-glow 3s ease-in-out infinite;
        }
    </style>
</head>
<body class="antialiased bg-black text-white min-h-screen">
    <!-- Animated Background Elements -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-20 right-20 w-72 h-72 bg-gradient-to-br from-purple-500/20 to-pink-500/20 rounded-full blur-3xl animate-pulse-glow"></div>
        <div class="absolute bottom-20 left-20 w-96 h-96 bg-gradient-to-tr from-blue-500/20 to-cyan-500/20 rounded-full blur-3xl animate-pulse-glow" style="animation-delay: 1.5s;"></div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-64 h-64 bg-gradient-to-r from-indigo-500/10 to-purple-500/10 rounded-full blur-2xl animate-float"></div>
    </div>

    <div class="relative z-10 flex items-center justify-center min-h-screen">
        <div class="text-center space-y-6 p-6 max-w-xl">
            <!-- Logo -->
            <div class="flex items-center justify-center gap-3 mb-6">
                <div class="relative">
                    <div class="absolute inset-0 bg-gradient-to-br from-purple-500 to-pink-500 rounded-3xl blur-xl opacity-50"></div>
                    <img src="/favicon.png" alt="EXM Logo" class="relative w-14 h-14 rounded-2xl shadow-2xl shadow-purple-500/50">
                </div>
                <h1 class="text-4xl font-bold text-white">EXM</h1>
            </div>

            <!-- Welcome Text -->
            <div class="space-y-4">
                <h2 class="text-2xl font-bold text-white leading-tight">
                    {{ __('Quản lý tài chính thông minh') }}
                </h2>
                <p class="text-white text-base leading-relaxed">
                    {{ __('Theo dõi chi tiêu và đạt mục tiêu tài chính của bạn') }}
                </p>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4 pt-4">
                @auth
                    <a href="{{ url('/dashboard') }}" class="w-full sm:w-auto px-8 py-3 rounded-2xl bg-white text-black font-bold hover:bg-zinc-200 transition-all duration-300 shadow-lg hover:shadow-xl hover:scale-[1.02]">
                        {{ __('Vào Dashboard') }}
                    </a>
                @else
                    <a href="{{ route('login') }}" class="w-full sm:w-auto px-8 py-3 rounded-2xl bg-white text-black font-bold hover:bg-zinc-200 transition-all duration-300 shadow-lg hover:shadow-xl hover:scale-[1.02]">
                        {{ __('Đăng nhập') }}
                    </a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="w-full sm:w-auto px-8 py-3 rounded-2xl bg-white text-black font-bold hover:bg-zinc-200 transition-all duration-300">
                            {{ __('Đăng ký') }}
                        </a>
                    @endif
                @endauth
            </div>

            <!-- Optional: Feature highlights -->
            <div class="flex gap-6 mt-10 pt-16 overflow-x-auto sm:overflow-visible sm:grid sm:grid-cols-3 sm:gap-5">
                <div class="min-w-56 flex flex-col items-center text-center space-y-3 sm:min-w-0">
                    <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-cyan-500 rounded-xl flex items-center justify-center shadow-lg shadow-blue-500/30">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                        </svg>
                    </div>
                    <div class="space-y-1">
                        <h3 class="text-white text-lg font-semibold">{{ __('Biểu đồ trực quan') }}</h3>
                        <p class="text-white text-sm">{{ __('Theo dõi xu hướng chi tiêu') }}</p>
                    </div>
                </div>

                <div class="min-w-56 flex flex-col items-center text-center space-y-3 sm:min-w-0">
                    <div class="w-10 h-10 bg-gradient-to-br from-purple-500 to-pink-500 rounded-xl flex items-center justify-center shadow-lg shadow-purple-500/30">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div class="space-y-1">
                        <h3 class="text-white text-lg font-semibold">{{ __('Phân loại thông minh') }}</h3>
                        <p class="text-white text-sm">{{ __('Tự động phân loại chi tiêu') }}</p>
                    </div>
                </div>

                <div class="min-w-56 flex flex-col items-center text-center space-y-3 sm:min-w-0">
                    <div class="w-10 h-10 bg-gradient-to-br from-green-500 to-emerald-500 rounded-xl flex items-center justify-center shadow-lg shadow-green-500/30">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                    </div>
                    <div class="space-y-1">
                        <h3 class="text-white text-lg font-semibold">{{ __('Bảo mật cao') }}</h3>
                        <p class="text-white text-sm">{{ __('Dữ liệu được bảo vệ an toàn') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
