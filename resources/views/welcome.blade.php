<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>GreenLink | L'avenir du Recyclage</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="icon" type="image/png" href="{{ asset('images/logo1.png') }}">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        @keyframes slow-spin { from { transform: rotate(0deg); } to { transform: rotate(360deg); } }
        .animate-slow-spin { animation: slow-spin 20s linear infinite; }
        .glass { background: rgba(255, 255, 255, 0.03); backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.1); }
    </style>
</head>
<body class="bg-[#020617] text-white selection:bg-emerald-500/30 selection:text-emerald-400">

    <div class="fixed inset-0 -z-10">
        <div class="absolute top-[-10%] right-[-10%] w-[50%] h-[50%] bg-emerald-600/20 rounded-full blur-[150px]"></div>
        <div class="absolute bottom-[-10%] left-[-10%] w-[50%] h-[50%] bg-teal-900/20 rounded-full blur-[150px]"></div>
        <div class="absolute inset-0 bg-[url('https://grainy-gradients.vercel.app/noise.svg')] opacity-20 brightness-100 contrast-150"></div>
    </div>

    <nav class="fixed top-0 w-full z-50 px-6 py-4">
        <div class="max-w-7xl mx-auto flex items-center justify-between glass px-6 py-4 rounded-[2rem]">
            <div class="flex items-center gap-3">
                <img src="{{ asset('images/logo.png') }}" class="h-10 w-auto brightness-125 scale-[1.8]" alt="Logo">
                <span class="text-xl font-black tracking-tighter uppercase">Green<span class="text-emerald-400">Link</span></span>
            </div>
            <div class="hidden md:flex items-center gap-8 font-bold text-[10px] uppercase tracking-[0.2em]">
                <a href="#impact" class="hover:text-emerald-400 transition">Impact</a>
                <a href="#how" class="hover:text-emerald-400 transition">Concept</a>
                @auth
                    <a href="{{ url('/dashboard') }}" class="bg-emerald-500 text-emerald-950 px-6 py-2.5 rounded-full hover:scale-105 transition-all">Tableau de bord</a>
                @else
                    <a href="{{ route('login') }}" class="hover:text-emerald-400 transition">Connexion</a>
                    <a href="{{ route('register') }}" class="bg-white text-black px-6 py-2.5 rounded-full hover:bg-emerald-400 hover:text-black transition-all">S'inscrire</a>
                @endauth
            </div>
        </div>
    </nav>

    <main class="relative pt-32 pb-20 px-6 overflow-hidden">
        <div class="max-w-7xl mx-auto grid lg:grid-cols-2 gap-16 items-center">
            
            <div class="relative z-10">
                <div class="inline-flex items-center gap-2 px-3 py-1 bg-emerald-500/10 border border-emerald-500/20 rounded-full mb-8">
                    <span class="w-1.5 h-1.5 bg-emerald-400 rounded-full animate-ping"></span>
                    <span class="text-[9px] font-black uppercase tracking-widest text-emerald-400 italic">Plateforme Connectée 2.0</span>
                </div>
                
                <h1 class="text-7xl md:text-8xl font-black leading-[0.9] tracking-tighter mb-8">
                    Recyclez <br> 
                    <span class="bg-clip-text text-transparent bg-gradient-to-r from-emerald-400 via-teal-300 to-emerald-500 italic uppercase">L'avenir.</span>
                </h1>
                
                <p class="text-gray-400 text-lg font-medium max-w-lg mb-10 leading-relaxed">
                    Transformez vos gestes quotidiens en <span class="text-white">GreenPoints</span>. Suivez votre impact CO2 en temps réel et gagnez des récompenses.
                </p>

                <div class="flex flex-wrap gap-5">
                    <a href="{{ route('register') }}" class="group relative px-10 py-5 bg-emerald-500 text-emerald-950 font-black rounded-2xl overflow-hidden hover:scale-105 transition-all">
                        <div class="absolute inset-0 bg-white/20 translate-x-[-100%] group-hover:translate-x-[100%] transition-transform duration-700"></div>
                        <span class="relative uppercase tracking-widest text-xs">Rejoindre le mouvement</span>
                    </a>
                </div>

                <div class="mt-16 flex items-center gap-8 border-t border-white/5 pt-10">
                    <div>
                        <p class="text-3xl font-black">+45K</p>
                        <p class="text-[9px] font-bold text-emerald-500 uppercase tracking-widest">Kg Recyclés</p>
                    </div>
                    <div class="w-[1px] h-10 bg-white/10"></div>
                    <div>
                        <p class="text-3xl font-black">+1.2K</p>
                        <p class="text-[9px] font-bold text-emerald-500 uppercase tracking-widest">Membres Actifs</p>
                    </div>
                </div>
            </div>

            <div class="relative">
                <div class="relative w-full aspect-square flex items-center justify-center">
                    <div class="absolute inset-0 border-[1px] border-emerald-500/20 rounded-full animate-slow-spin"></div>
                    <div class="absolute inset-10 border-[1px] border-emerald-500/10 rounded-full animate-slow-spin [animation-direction:reverse]"></div>
                    
                    <div class="absolute top-10 right-10 glass p-6 rounded-[2rem] animate-bounce [animation-duration:5s] z-20">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 bg-emerald-400 rounded-full flex items-center justify-center text-black">
                                <i class="fas fa-leaf"></i>
                            </div>
                            <div>
                                <p class="text-[10px] font-black uppercase text-emerald-400">Impact CO2</p>
                                <p class="text-xl font-black">-120kg</p>
                            </div>
                        </div>
                    </div>

                    <div class="relative w-80 h-80 rounded-[3rem] overflow-hidden rotate-6 shadow-2xl shadow-emerald-500/20 border-4 border-emerald-500/30">
                        <img src="https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?auto=format&fit=crop&q=80&w=1000" class="w-full h-full object-cover scale-110 hover:scale-100 transition-transform duration-700" alt="Nature">
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer class="py-10 text-center relative z-10 border-t border-white/5">
        <p class="text-[10px] font-black uppercase tracking-[0.5em] text-gray-500">
            &copy; 2026 — Built for <span class="text-emerald-400">Sustainability</span>
        </p>
    </footer>

</body>
</html>