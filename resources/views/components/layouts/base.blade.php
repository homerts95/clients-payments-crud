<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? config('app.name', 'Laravel') }}</title>

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>

    {{-- Styles / Scripts --}}
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <style>
            /* Fallback Tailwind CSS */
            {!! file_get_contents(public_path('css/app.css')) !!}
        </style>
    @endif

    {{-- Additional Styles Slot --}}
    @stack('styles')
</head>
<body class="font-sans antialiased dark:bg-black dark:text-white/50">
<div class="bg-gray-50 text-black/50 dark:bg-black dark:text-white/50">
    @stack('background')
    <div
        class="relative min-h-screen flex flex-col items-center justify-center selection:bg-[#FF2D20] selection:text-white">
        <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">
                <div class="flex lg:justify-center lg:col-start-2">
                    @stack('logo')
                </div>

                <nav class="-mx-3 flex flex-1 justify-start">

                    <a href="{{route('clients.index')}}" class="px-3 py-2 mr-2 rounded-md text-sm font-medium {{ request()->routeIs('clients.index') ? 'bg-gray-900 text-white' : 'text-gray-500 hover:text-gray-700 dark:hover:text-white/70' }}">
                        Clients
                    </a>
                    <a href="{{route('payments.index')}}"
                       class="px-3 py-2 mr-2 rounded-md text-sm font-medium {{ request()->routeIs('payments.index') ? 'bg-gray-900 text-white' : 'text-gray-500 hover:text-gray-700 dark:hover:text-white/70' }}">
                        Payments
                    </a>
                </nav>


            {{-- Main Content Section --}}
            <main class="mt-6">
                {{ $slot }}
            </main>

            <footer class="py-16 text-center text-sm text-black dark:text-white/70">
                {{ $footer ?? 'Laravel v' . Illuminate\Foundation\Application::VERSION . ' (PHP v' . PHP_VERSION . ')' }}
            </footer>
        </div>
    </div>
</div>

{{-- Scripts Slot --}}
@stack('scripts')
</body>
</html>
