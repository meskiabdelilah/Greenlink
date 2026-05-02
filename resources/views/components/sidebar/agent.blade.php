<aside class="w-72 bg-[#020617] h-screen sticky top-0 flex flex-col overflow-hidden shadow-[20px_0_50px_rgba(0,0,0,0.2)] relative border-r border-white/5">

    {{-- Effects --}}
    <div class="absolute inset-0 bg-grainy opacity-10 pointer-events-none"></div>
    <div class="absolute -top-24 -left-24 w-64 h-64 bg-blue-500/10 rounded-full blur-[100px] animate-pulse"></div>
    <div class="absolute bottom-20 -right-20 w-40 h-40 bg-emerald-500/5 rounded-full blur-[80px]"></div>

    {{-- Logo Section --}}
    <div class="px-6 py-12 flex items-center justify-center overflow-hidden relative">
        <a href="{{ route('agent.dashboard') }}" class="group relative flex flex-col items-center gap-3">
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
                <span class="text-[8px] font-black uppercase tracking-[0.4em] text-emerald-500/40 -mt-1">Terminal agent</span>
            </div>
        </a>
    </div>

    {{-- Navigation --}}
    <nav class="relative z-10 flex-1 px-4 space-y-1.5 overflow-y-auto custom-sidebar-scroll">
        <p class="px-4 text-[9px] font-black uppercase tracking-[0.4em] text-gray-500 mb-6">Centre des opérations</p>

        {{-- 1. Radar (All available missions) --}}
        @php $active = request()->is('agent/dashboard'); @endphp
        <a href="{{ route('agent.dashboard') }}" class="group relative flex items-center gap-4 px-5 py-4 rounded-2xl transition-all duration-300 {{ $active ? 'bg-white/[0.05] border border-white/10 shadow-xl' : 'text-gray-400 hover:text-white hover:bg-white/[0.02]' }}">
            @if($active)
            <div class="absolute left-0 w-1.5 h-6 bg-emerald-500 rounded-r-full shadow-[0_0_15px_#10b981]"></div>
            @endif
            <i class="fas fa-satellite-dish text-lg {{ $active ? 'text-emerald-400' : 'group-hover:text-emerald-400 transition-colors' }}"></i>
            <span class="font-bold text-[13px] tracking-wide {{ $active ? 'text-white' : '' }}">Tableau de bord</span>
        </a>

        {{-- 2. Dépôts en attente --}}
        @php $active = request()->is('agent/deposits/pending*'); @endphp
        <a href="{{ route('agent.deposits.pending') }}" class="group relative flex items-center gap-4 px-5 py-4 rounded-2xl transition-all duration-300 {{ $active ? 'bg-white/[0.05] border border-white/10 shadow-xl' : 'text-gray-400 hover:text-white hover:bg-white/[0.02]' }}">
            @if($active)
            <div class="absolute left-0 w-1.5 h-6 bg-emerald-500 rounded-r-full shadow-[0_0_15px_#10b981]"></div>
            @endif
            <i class="fas fa-inbox text-lg {{ $active ? 'text-emerald-400' : 'group-hover:text-emerald-400 transition-colors' }}"></i>
            <div class="flex flex-col">
                <span class="font-bold text-[13px] tracking-wide {{ $active ? 'text-white' : '' }}">Depots en attente</span>
                <span class="text-[8px] font-black text-emerald-500/50 uppercase tracking-widest mt-0.5 italic text-left">Disponibles</span>
            </div>
        </a>

        {{-- 3. Missions affectées --}}
        @php $active = request()->is('agent/deposits/assigned*'); @endphp
        <a href="{{ route('agent.deposits.assigned') }}" class="group relative flex items-center gap-4 px-5 py-4 rounded-2xl transition-all duration-300 {{ $active ? 'bg-white/[0.05] border border-white/10 shadow-xl' : 'text-gray-400 hover:text-white hover:bg-white/[0.02]' }}">
            @if($active)
            <div class="absolute left-0 w-1.5 h-6 bg-emerald-500 rounded-r-full shadow-[0_0_15px_#10b981]"></div>
            @endif
            <i class="fas fa-tasks text-lg {{ $active ? 'text-emerald-400' : 'group-hover:text-emerald-400 transition-colors' }}"></i>
            <div class="flex flex-col">
                <span class="font-bold text-[13px] tracking-wide {{ $active ? 'text-white' : '' }}">Dépôts affectés</span>
                {{-- Badge optionnel pour montrer le nombre de missions en cours --}}
                <span class="text-[8px] font-black text-emerald-500/50 uppercase tracking-widest mt-0.5 italic text-left">Traitement</span>
            </div>
        </a>

        {{-- 4. Archive (Historique) --}}
        @php $active = request()->is('agent/deposits/history*'); @endphp
        <a href="{{route('agent.deposits.history')}}" class="group relative flex items-center gap-4 px-5 py-4 rounded-2xl transition-all duration-300 {{ $active ? 'bg-white/[0.05] border border-white/10 shadow-xl' : 'text-gray-400 hover:text-white hover:bg-white/[0.02]' }}">
            @if($active)
            <div class="absolute left-0 w-1.5 h-6 bg-emerald-500 rounded-r-full shadow-[0_0_15px_#10b981]"></div>
            @endif
            <i class="fas fa-clock-rotate-left text-lg {{ $active ? 'text-emerald-400' : 'group-hover:text-emerald-400 transition-colors' }}"></i>
            <span class="font-bold text-[13px] tracking-wide {{ $active ? 'text-white' : '' }}">Historique</span>
        </a>
    </nav>

</aside>
