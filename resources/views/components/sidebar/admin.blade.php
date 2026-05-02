<aside class="w-72 bg-[#020617] h-screen sticky top-0 flex flex-col overflow-hidden shadow-[20px_0_50px_rgba(0,0,0,0.5)] relative border-r border-white/5">

    {{-- Background Effects --}}
    <div class="absolute inset-0 bg-grainy opacity-10 pointer-events-none"></div>
    <div class="absolute -top-24 -left-24 w-64 h-64 bg-emerald-500/10 rounded-full blur-[100px] animate-pulse"></div>
    <div class="absolute bottom-20 -right-20 w-40 h-40 bg-blue-500/5 rounded-full blur-[80px]"></div>

    {{-- Logo Section --}}
    <div class="px-6 py-12 flex items-center justify-center overflow-hidden relative">
        <a href="{{ route('admin.dashboard') }}" class="group relative flex flex-col items-center gap-3">
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-24 h-24 bg-emerald-500/20 blur-[40px] rounded-full opacity-0 group-hover:opacity-100 transition-all duration-700"></div>

            <div class="relative w-16 h-16 flex items-center justify-center transition-all duration-500 group-hover:scale-110">
                <img src="{{ asset('images/logo.png') }}"
                    alt="Administration GreenLink"
                    class="w-full h-full object-contain brightness-125 drop-shadow-[0_0_15px_rgba(16,185,129,0.5)] scale-[2.5]">
            </div>

            <div class="relative z-10 flex flex-col items-center">
                <span class="text-xl font-black tracking-tighter text-white uppercase">
                    Green<span class="text-emerald-400 italic">Link</span>
                </span>
                <span class="text-[8px] font-black uppercase tracking-[0.4em] text-emerald-500/40 -mt-1 tracking-[0.5em]">Noyau central</span>
            </div>
        </a>
    </div>

    {{-- Navigation --}}
    <nav class="relative z-10 flex-1 px-4 space-y-1.5 overflow-y-auto custom-sidebar-scroll">
        <p class="px-4 text-[9px] font-black uppercase tracking-[0.4em] text-gray-500 mb-6 italic">Supervision système</p>

        {{-- 1. Tableau de bord / statistiques --}}
        @php $active = request()->is('admin/dashboard*'); @endphp
        <a href="{{ route('admin.dashboard') }}" class="group relative flex items-center gap-4 px-5 py-4 rounded-2xl transition-all duration-300 {{ $active ? 'bg-white/[0.05] border border-white/10 shadow-xl' : 'text-gray-400 hover:text-white hover:bg-white/[0.02]' }}">
            @if($active)
                <div class="absolute left-0 w-1.5 h-6 bg-emerald-500 rounded-r-full shadow-[0_0_15px_#10b981]"></div>
            @endif
            <i class="fas fa-microchip text-lg {{ $active ? 'text-emerald-400' : 'group-hover:text-emerald-400' }}"></i>
            <span class="font-bold text-[13px] tracking-wide {{ $active ? 'text-white' : '' }}">Console stats</span>
        </a>

        {{-- 2. Gestion des utilisateurs --}}
        @php $active = request()->is('admin/users*'); @endphp
        <a href="{{ route('admin.users.index') }}" class="group relative flex items-center gap-4 px-5 py-4 rounded-2xl transition-all duration-300 {{ $active ? 'bg-white/[0.05] border border-white/10 shadow-xl' : 'text-gray-400 hover:text-white hover:bg-white/[0.02]' }}">
            @if($active)
                <div class="absolute left-0 w-1.5 h-6 bg-emerald-500 rounded-r-full shadow-[0_0_15px_#10b981]"></div>
            @endif
            <i class="fas fa-users-gear text-lg {{ $active ? 'text-emerald-400' : 'group-hover:text-emerald-400' }}"></i>
            <span class="font-bold text-[13px] tracking-wide {{ $active ? 'text-white' : '' }}">Unités & Rôles</span>
        </a>

        {{-- 3. Flux de Collecte (Deposits) --}}
        @php $active = request()->is('admin/deposits*'); @endphp
        <a href="{{ route('admin.deposits.index') }}" class="group relative flex items-center gap-4 px-5 py-4 rounded-2xl transition-all duration-300 {{ $active ? 'bg-white/[0.05] border border-white/10 shadow-xl' : 'text-gray-400 hover:text-white hover:bg-white/[0.02]' }}">
            @if($active)
                <div class="absolute left-0 w-1.5 h-6 bg-emerald-500 rounded-r-full shadow-[0_0_15px_#10b981]"></div>
            @endif
            <i class="fas fa-satellite-dish text-lg {{ $active ? 'text-emerald-400' : 'group-hover:text-emerald-400' }}"></i>
            <span class="font-bold text-[13px] tracking-wide {{ $active ? 'text-white' : '' }}">Flux de Collecte</span>
        </a>

        {{-- 4. Récompenses --}}
        @php $active = request()->is('admin/rewards*'); @endphp
        <a href="{{ route('admin.rewards.index') }}" class="group relative flex items-center gap-4 px-5 py-4 rounded-2xl transition-all duration-300 {{ $active ? 'bg-white/[0.05] border border-white/10 shadow-xl' : 'text-gray-400 hover:text-white hover:bg-white/[0.02]' }}">
            @if($active)
                <div class="absolute left-0 w-1.5 h-6 bg-emerald-500 rounded-r-full shadow-[0_0_15px_#10b981]"></div>
            @endif
            <i class="fas fa-gift text-lg {{ $active ? 'text-emerald-400' : 'group-hover:text-emerald-400' }}"></i>
            <span class="font-bold text-[13px] tracking-wide {{ $active ? 'text-white' : '' }}">Récompenses</span>
        </a>

        {{-- 5. Paramètres des flux (catégories) --}}
        @php $active = request()->is('admin/categories*'); @endphp
        <a href="{{ route('admin.categories.index') }}" class="group relative flex items-center gap-4 px-5 py-4 rounded-2xl transition-all duration-300 {{ $active ? 'bg-white/[0.05] border border-white/10 shadow-xl' : 'text-gray-400 hover:text-white hover:bg-white/[0.02]' }}">
            @if($active)
                <div class="absolute left-0 w-1.5 h-6 bg-emerald-500 rounded-r-full shadow-[0_0_15px_#10b981]"></div>
            @endif
            <i class="fas fa-layer-group text-lg {{ $active ? 'text-emerald-400' : 'group-hover:text-emerald-400' }}"></i>
            <span class="font-bold text-[13px] tracking-wide {{ $active ? 'text-white' : '' }}">Paramètres Flux</span>
        </a>

    </nav>

    {{-- Statut de sécurité inférieur --}}
    <div class="relative z-10 p-6">
        <div class="bg-rose-500/[0.03] backdrop-blur-xl border border-rose-500/10 rounded-[2rem] p-5 group cursor-default overflow-hidden relative border-l-2 border-l-rose-500/50">
            <div class="absolute -top-10 -left-10 w-20 h-20 bg-rose-500/5 rounded-full blur-2xl"></div>

            <div class="relative z-10">
                <div class="flex items-center gap-3 mb-2">
                    <div class="w-1.5 h-1.5 bg-rose-500 rounded-full animate-pulse shadow-[0_0_8px_#f43f5e]"></div>
                    <span class="text-[9px] font-black uppercase tracking-widest text-rose-500/80">Niveau de sécurité 01</span>
                </div>
                <p class="text-gray-400 text-[10px] font-medium leading-tight italic uppercase tracking-tighter">
                    Authentifié comme : <span class="text-white font-mono uppercase tracking-normal">Root_Admin</span>
                </p>
            </div>
        </div>
    </div>
</aside>

<style>
    .bg-grainy {
        background-image: url("https://grainy-gradients.vercel.app/noise.svg");
        filter: contrast(150%) brightness(50%);
    }

    .custom-sidebar-scroll::-webkit-scrollbar {
        width: 3px;
    }

    .custom-sidebar-scroll::-webkit-scrollbar-thumb {
        background: rgba(16, 185, 129, 0.2);
        border-radius: 10px;
    }
</style>
