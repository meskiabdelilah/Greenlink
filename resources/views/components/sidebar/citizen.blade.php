<aside class="w-72 bg-[#020617] h-screen sticky top-0 flex flex-col overflow-hidden shadow-[20px_0_50px_rgba(0,0,0,0.2)] relative border-r border-white/5">

    <div class="absolute inset-0 bg-grainy opacity-10 pointer-events-none"></div>
    <div class="absolute -top-24 -left-24 w-64 h-64 bg-emerald-500/10 rounded-full blur-[100px] animate-pulse"></div>
    <div class="absolute bottom-20 -right-20 w-40 h-40 bg-teal-500/5 rounded-full blur-[80px]"></div>

    <div class="px-6 py-12 flex items-center justify-center overflow-hidden relative">
        <a href="{{ route('dashboard') }}" class="group relative flex flex-col items-center gap-3">
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-24 h-24 bg-emerald-500/20 blur-[40px] rounded-full opacity-0 group-hover:opacity-100 transition-all duration-700"></div>

            <div class="relative w-16 h-16 flex items-center justify-center transition-all duration-500 group-hover:scale-110">
                <img src="{{ asset('images/logo.png') }}"
                    alt="Icône GreenLink"
                    class="w-full h-full object-contain brightness-125 drop-shadow-[0_0_10px_rgba(16,185,129,0.5)] scale-[2]">
            </div>

            <div class="relative z-10 flex flex-col items-center">
                <span class="text-xl font-black tracking-tighter text-white uppercase group-hover:tracking-normal transition-all duration-500">
                    Green<span class="text-emerald-400 italic">Link</span>
                </span>
                <div class="w-8 h-[1px] bg-emerald-500/30 group-hover:w-full transition-all duration-700 rounded-full mt-1"></div>
            </div>
        </a>
    </div>

    <nav class="relative z-10 flex-1 px-4 space-y-1.5 overflow-y-auto custom-sidebar-scroll">
        <p class="px-4 text-[9px] font-black uppercase tracking-[0.4em] text-gray-500 mb-6">Interface principale</p>

        {{-- Tableau de bord --}}
        @php $active = request()->routeIs('dashboard'); @endphp
        <a href="{{ route('dashboard') }}" class="group relative flex items-center gap-4 px-5 py-4 rounded-2xl transition-all duration-300 {{ $active ? 'bg-white/[0.05] border border-white/10 shadow-xl' : 'text-gray-400 hover:text-white hover:bg-white/[0.02]' }}">
            @if($active)
                <div class="absolute left-0 w-1.5 h-6 bg-emerald-500 rounded-r-full shadow-[0_0_15px_#10b981]"></div>
            @endif
            <i class="fas fa-th-large text-lg {{ $active ? 'text-emerald-400' : 'group-hover:text-emerald-400 transition-colors' }}"></i>
            <span class="font-bold text-[13px] tracking-wide {{ $active ? 'text-white' : '' }}">Tableau de bord</span>
        </a>

        {{-- Nouveau dépôt --}}
        @php $active = request()->routeIs('citizen.deposits.create'); @endphp
        <a href="{{route('citizen.deposits.create')}}" class="group relative flex items-center gap-4 px-5 py-4 rounded-2xl transition-all duration-300 {{ $active ? 'bg-emerald-500/10 border border-emerald-500/20 shadow-lg shadow-emerald-500/5' : 'text-gray-400 hover:text-white hover:bg-white/[0.02]' }}">
            @if($active)
                <div class="absolute left-0 w-1.5 h-6 bg-emerald-400 rounded-r-full shadow-[0_0_15px_#10b981]"></div>
            @endif
            <i class="fas fa-plus-circle text-lg {{ $active ? 'text-emerald-400' : 'text-emerald-500/60 group-hover:text-emerald-400' }}"></i>
            <span class="font-bold text-[13px] tracking-wide {{ $active ? 'text-emerald-400' : 'group-hover:text-emerald-300' }}">Nouveau Dépôt</span>
        </a>

        {{-- Mes dépôts --}}
        @php $active = request()->routeIs('citizen.deposits.index', 'citizen.deposits.show', 'citizen.deposits.edit'); @endphp
        <a href="{{route('citizen.deposits.index')}}" class="group relative flex items-center gap-4 px-5 py-4 rounded-2xl transition-all duration-300 {{ $active ? 'bg-white/[0.05] border border-white/10 shadow-xl' : 'text-gray-400 hover:text-white hover:bg-white/[0.02]' }}">
            @if($active)
                <div class="absolute left-0 w-1.5 h-6 bg-emerald-500 rounded-r-full shadow-[0_0_15px_#10b981]"></div>
            @endif
            <i class="fas fa-leaf text-lg {{ $active ? 'text-emerald-400' : 'group-hover:text-emerald-400 transition-colors' }}"></i>
            <span class="font-bold text-[13px] tracking-wide {{ $active ? 'text-white' : '' }}">Mes Collectes</span>
        </a>

        {{-- Mes récompenses --}}
        @php $active = request()->routeIs('citizen.rewards.*'); @endphp
        <a href="{{ route('citizen.rewards.index') }}" class="group relative flex items-center gap-4 px-5 py-4 rounded-2xl transition-all duration-300 {{ $active ? 'bg-white/[0.05] border border-white/10 shadow-xl' : 'text-gray-400 hover:text-white hover:bg-white/[0.02]' }}">
            @if($active)
                <div class="absolute left-0 w-1.5 h-6 bg-emerald-500 rounded-r-full shadow-[0_0_15px_#10b981]"></div>
            @endif
            <i class="fas fa-coins text-lg {{ $active ? 'text-emerald-400' : 'group-hover:text-emerald-400 transition-colors' }}"></i>
            <span class="font-bold text-[13px] tracking-wide {{ $active ? 'text-white' : '' }}">Mes Récompenses</span>
        </a>
    </nav>

    <div class="relative z-10 p-6">
        <div class="bg-white/[0.03] backdrop-blur-xl border border-white/5 rounded-[2rem] p-5 group cursor-default overflow-hidden relative">
            <div class="absolute -top-10 -left-10 w-20 h-20 bg-emerald-500/10 rounded-full blur-2xl group-hover:bg-emerald-500/20 transition-all duration-700"></div>

            <div class="relative z-10">
                <div class="flex items-center gap-3 mb-3">
                    <div class="w-1.5 h-1.5 bg-emerald-500 rounded-full animate-ping"></div>
                    <span class="text-[9px] font-black uppercase tracking-widest text-emerald-500/80">Statistiques en temps réel</span>
                </div>
                <p class="text-gray-400 text-[11px] font-medium leading-relaxed">
                    Votre impact écologique est <span class="text-white font-bold italic">propulsé par GreenLink</span>.
                </p>
            </div>
        </div>
    </div>
</aside>

<style>
    /* Grainy Background Effect */
    .bg-grainy {
        background-image: url("https://grainy-gradients.vercel.app/noise.svg");
        filter: contrast(150%) brightness(50%);
    }

    .custom-sidebar-scroll::-webkit-scrollbar {
        width: 3px;
    }

    .custom-sidebar-scroll::-webkit-scrollbar-thumb {
        background: rgba(16, 185, 129, 0.1);
        border-radius: 10px;
    }
    
    .custom-sidebar-scroll::-webkit-scrollbar-thumb:hover {
        background: rgba(16, 185, 129, 0.3);
    }
</style>
