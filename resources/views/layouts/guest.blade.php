<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'GreenLink') }}</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo1.png') }}">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .bg-grainy {
            background-image: url("https://grainy-gradients.vercel.app/noise.svg");
            filter: contrast(150%) brightness(100%);
        }

        ::-webkit-scrollbar {
            width: 5px;
        }

        ::-webkit-scrollbar-track {
            background: #020617;
        }

        ::-webkit-scrollbar-thumb {
            background: #10b981;
            border-radius: 10px;
        }
    </style>
</head>

<body class="font-sans text-white antialiased selection:bg-emerald-500/30 selection:text-emerald-400">

    <div class="min-h-screen bg-[#020617] relative flex flex-col items-center justify-center overflow-hidden">

        <div class="absolute inset-0 z-0">
            <div class="absolute -top-[10%] -left-[10%] w-[50%] h-[50%] bg-emerald-600/10 rounded-full blur-[120px] animate-pulse"></div>
            <div class="absolute -bottom-[10%] -right-[10%] w-[50%] h-[50%] bg-teal-900/20 rounded-full blur-[120px]"></div>
            <div class="absolute inset-0 bg-grainy opacity-20 mix-blend-overlay"></div>
        </div>

        <div class="relative z-10 w-full">
            {{ $slot }}
        </div>

        <div class="relative z-10 py-10 opacity-30 group">
            <div class="flex flex-col items-center gap-4">
                <div class="h-[1px] w-12 bg-gradient-to-r from-transparent via-emerald-500 to-transparent group-hover:w-24 transition-all duration-700"></div>
                <p class="text-[9px] font-black uppercase tracking-[0.6em]">
                    {{ config('app.name') }} <span class="text-emerald-500 italic">Protocol</span> &copy; {{ date('Y') }}
                </p>
            </div>
        </div>

    </div>

    <script>
        document.body.style.opacity = '0';
        window.addEventListener('DOMContentLoaded', () => {
            document.body.style.transition = 'opacity 0.8s ease-out';
            document.body.style.opacity = '1';
        });
    </script>
</body>

</html>