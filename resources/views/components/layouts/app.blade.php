<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-[#fafafa] dark:bg-[#09090b]">
<head>
    @include('partials.head')
    <style>
        [x-cloak] { display: none !important; }
        .glass {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        .dark .glass {
            background: rgba(9, 9, 11, 0.7);
            border: 1px solid rgba(255, 255, 255, 0.05);
        }
        body { font-family: 'Segoe UI', system-ui, -apple-system, sans-serif; }
        h1, h2, h3, h4, .font-display { font-family: 'Segoe UI', system-ui, -apple-system, sans-serif; font-weight: 600; }
        
        /* Sidebar navigation styling */
        .sidebar-nav-item {
            font-size: 48px !important;
            font-weight: 700 !important;
            padding: 24px 24px !important;
            line-height: 1.2 !important;
        }
        
        /* Icon size proportional to text */
        .sidebar-nav-item svg {
            width: 48px !important;
            height: 48px !important;
        }
    </style>
</head>
<body class="h-full antialiased text-zinc-900 dark:text-zinc-100">
    <div class="flex min-h-screen relative">
        <!-- Sidebar - Core Navigation + Bottom Profile -->
        <flux:sidebar sticky stashable class="glass border-r border-zinc-200/50 dark:border-zinc-800/50 !bg-transparent flex flex-col">
            <div class="flex-1 flex flex-col min-h-0">
                <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />

                <!-- Logo -->
                <div class="flex items-center justify-center px-4 py-6">
                    <img src="/favicon.svg" alt="EXM Logo" class="size-12">
                </div>

                <!-- Main Navigation -->
                <div class="px-2 space-y-4">
                    <flux:navlist.item icon="chart-bar" href="{{ route('dashboard') }}" :current="request()->routeIs('dashboard')" class="sidebar-nav-item">{{ __('Bảng điều khiển') }}</flux:navlist.item>
                    <flux:navlist.item icon="tag" href="{{ route('categories.index') }}" :current="request()->routeIs('categories.*')" class="sidebar-nav-item">{{ __('Danh mục') }}</flux:navlist.item>
                    <flux:navlist.item icon="credit-card" href="{{ route('expenses.index') }}" :current="request()->routeIs('expenses.*')" class="sidebar-nav-item">{{ __('Chi tiêu') }}</flux:navlist.item>
                </div>

                <flux:spacer />
            </div>

            <!-- Bottom Profile Section -->
            <div class="border-t border-zinc-200/50 dark:border-zinc-800/50 p-3 mt-auto">
                <flux:dropdown position="top" align="start">
                    <!-- Trigger Button: Avatar + Name -->
                    <flux:button variant="ghost" class="w-full group !p-2 rounded-lg hover:bg-zinc-100 dark:hover:bg-zinc-800 transition-colors justify-start">
                        <div class="flex items-center gap-2.5 w-full min-w-0">
                            <!-- Avatar -->
                            <div class="size-8 rounded-lg bg-gradient-to-br from-primary to-primary-600 flex items-center justify-center text-white font-bold text-sm shadow-sm ring-1 ring-white/10 flex-shrink-0">
                                {{ substr(Auth::user()->name, 0, 1) }}
                            </div>
                            <!-- User Info -->
                            <div class="hidden lg:block text-left min-w-0">
                                <div class="text-[15px] font-medium leading-none truncate">{{ Auth::user()->name }}</div>
                                <div class="text-[11px] text-zinc-500 mt-1 uppercase tracking-wider font-semibold">{{ __('Thành viên') }}</div>
                            </div>
                        </div>
                    </flux:button>

                    <!-- Dropdown Menu -->
                    <flux:menu class="w-48">
                        <!-- Settings Section -->
                        <div class="px-2 py-2">
                            <flux:menu.item :href="route('profile.edit')" icon="cog-6-tooth">{{ __('Cài đặt') }}</flux:menu.item>
                        </div>

                        <!-- Logout Section -->
                        <flux:menu.separator />
                        <div class="px-2 py-2">
                            <form method="POST" action="{{ route('logout') }}" class="w-full">
                                @csrf
                                <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full text-left text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20">
                                    {{ __('Đăng xuất') }}
                                </flux:menu.item>
                            </form>
                        </div>
                    </flux:menu>
                </flux:dropdown>
            </div>
        </flux:sidebar>

        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col min-w-0">
            <!-- Top Navbar -->
            <header class="sticky top-0 z-40 glass border-b border-zinc-200/50 dark:border-zinc-800/50 px-4 md:px-8 py-3 flex items-center justify-between hidden">
                <div class="flex items-center gap-4">
                    <flux:sidebar.toggle class="lg:hidden" icon="bars-3" />
                    <h1 class="text-lg font-semibold font-display hidden md:block">{{ $title ?? __('Tổng quan') }}</h1>
                </div>

                <div class="flex items-center gap-4">
                    <flux:dropdown>
                        <flux:button variant="ghost" icon="plus" class="rounded-full !size-9 hidden md:flex items-center justify-center bg-zinc-100 dark:bg-zinc-800" />

                        <flux:menu>
                            <flux:menu.item :href="route('expenses.create')" icon="credit-card">{{ __('Thêm chi tiêu') }}</flux:menu.item>
                            <flux:menu.item :href="route('categories.create')" icon="tag">{{ __('Thêm danh mục') }}</flux:menu.item>
                        </flux:menu>
                    </flux:dropdown>
                </div>
            </header>

            <flux:main class="p-4 md:p-8">
                <div class="max-w-7xl mx-auto space-y-8 animate-in fade-in duration-700">
                    {{ $slot }}
                </div>
            </flux:main>
        </div>


    </div>

    @persist('flux-runtime')
        @fluxScripts
    @endpersist
</body>
</html>
