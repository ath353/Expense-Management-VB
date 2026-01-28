@props([
'sidebar' => false,
])

@if($sidebar)
    <flux:sidebar.brand name="EXM" {{ $attributes }}>
        <x-slot name="logo">
            <img src="/favicon.png" alt="EXM Logo" class="size-8 rounded-md">
        </x-slot>
    </flux:sidebar.brand>
@else
    <flux:brand name="EXM" {{ $attributes }}>
        <x-slot name="logo">
            <img src="/favicon.png" alt="EXM Logo" class="size-8 rounded-md">
        </x-slot>
    </flux:brand>
@endif
