<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'GreenLink') }}</title>

    <link rel="icon" type="image/png" href="{{ asset('images/logo1.png') }}">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:300,400,500,600,700,900&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* Custom scrollbar for a tech look */
        ::-webkit-scrollbar { width: 5px; }
        ::-webkit-scrollbar-track { background: #020617; }
        ::-webkit-scrollbar-thumb { background: #1e293b; border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: #10b981; }
        
        body { background-color: #020617; }
    </style>
</head>


<body class="font-sans antialiased text-gray-300 selection:bg-emerald-500/30 selection:text-emerald-400">

    <div class="fixed inset-0 z-0 overflow-hidden pointer-events-none">
        <div class="absolute -top-[10%] -left-[10%] w-[40%] h-[40%] bg-emerald-500/5 rounded-full blur-[120px]"></div>
        <div class="absolute top-[20%] -right-[5%] w-[30%] h-[30%] bg-blue-500/5 rounded-full blur-[100px]"></div>
    </div>

    <div class="relative z-10 flex h-screen overflow-hidden">

        @auth
            <aside class="flex-shrink-0">
                @if (auth()->user()->role === 'admin')
                    <x-sidebar.admin />
                @elseif (auth()->user()->role === 'agent')
                    <x-sidebar.agent />
                @else
                    <x-sidebar.citizen />
                @endif
            </aside>
        @endauth

        <div class="flex flex-col flex-1 min-w-0 bg-transparent">

            @include('layouts.navigation')

            @isset($header)
            <header class="bg-[#020617]/50 backdrop-blur-md border-b border-white/5 px-8 py-6">
                <div class="max-w-7xl mx-auto">
                    <div class="text-white">
                        {{ $header }}
                    </div>
                </div>
            </header>
            @endisset

            <!-- <div class="max-w-7xl mx-auto w-full px-8 mt-6">
                @if (session('success'))
                <div class="bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 px-6 py-4 rounded-2xl flex items-center gap-4 shadow-2xl shadow-emerald-500/5 animate-fade-in-up">
                    <i class="fas fa-check-double text-lg shadow-[0_0_10px_#10b981]"></i>
                    <span class="text-xs font-black uppercase tracking-[0.1em]">{{ session('success') }}</span>
                </div>
                @endif

                @if (session('error'))
                <div class="bg-rose-500/10 border border-rose-500/20 text-rose-400 px-6 py-4 rounded-2xl flex items-center gap-4 shadow-2xl shadow-rose-500/5 animate-fade-in-up">
                    <i class="fas fa-bolt text-lg"></i>
                    <span class="text-xs font-black uppercase tracking-[0.1em]">{{ session('error') }}</span>
                </div>
                @endif
            </div> -->

            <main class="flex-1 overflow-y-auto overflow-x-hidden px-8 py-8 custom-scrollbar">
                <div class="max-w-7xl mx-auto">
                    {{ $slot }}
                </div>
            </main>

        </div>
    </div>

</body>

</html>