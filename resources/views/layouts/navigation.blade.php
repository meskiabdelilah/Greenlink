<nav class="sticky top-0 z-50 bg-[#020617]/80 backdrop-blur-xl border-b border-white/5 transition-all duration-300">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="flex justify-between h-20 items-center gap-8">

            <div class="flex-1 flex items-center">
                <div class="relative w-full max-w-md group">
                    <span class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="h-4 w-4 text-emerald-500/40 group-focus-within:text-emerald-400 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </span>
                    <input type="text" 
                           placeholder="Rechercher un dépôt, un utilisateur..." 
                           class="block w-full pl-11 pr-4 py-2.5 bg-white/[0.03] border border-white/5 text-sm rounded-2xl focus:ring-4 focus:ring-emerald-500/10 focus:bg-white/[0.07] focus:border-emerald-500/30 transition-all outline-none text-gray-300 font-medium placeholder:text-gray-600">
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:gap-5">

                {{-- Notifications: Neon Style --}}
                <button class="relative p-2.5 text-gray-500 hover:text-emerald-400 hover:bg-white/5 rounded-2xl transition-all duration-300 group">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                    </svg>
                    <span class="absolute top-2.5 right-2.5 w-2 h-2 bg-emerald-500 rounded-full shadow-[0_0_8px_#10b981] animate-pulse"></span>
                </button>

                {{-- Menu du profil utilisateur --}}
                <div class="relative pl-5 border-l border-white/10">
                    <x-dropdown align="right" width="64">
                        <x-slot name="trigger">
                            <button class="flex items-center gap-3 p-1.5 rounded-2xl hover:bg-white/5 transition-all group">
                                <div class="relative p-0.5 rounded-xl bg-gradient-to-tr from-emerald-600 to-teal-400 shadow-lg shadow-emerald-900/20 group-hover:scale-105 transition-transform">
                                    <div class="w-9 h-9 bg-[#020617] rounded-[10px] flex items-center justify-center text-emerald-400 text-[13px] font-black border border-white/10 uppercase">
                                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                    </div>
                                </div>
                                
                                <div class="text-left hidden md:block">
                                    <p class="text-xs font-black text-white group-hover:text-emerald-400 transition-colors leading-tight">{{ Auth::user()->name }}</p>
                                    <div class="flex items-center gap-1.5 mt-0.5">
                                        <div class="w-1 h-1 bg-emerald-500 rounded-full shadow-[0_0_5px_#10b981]"></div>
                                        <p class="text-[9px] font-black text-emerald-500/60 uppercase tracking-[0.15em] italic">En ligne</p>
                                    </div>
                                </div>
                                <svg class="w-3.5 h-3.5 text-gray-600 group-hover:text-emerald-400 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <div class="bg-[#0f172a] border border-white/10 rounded-2xl overflow-hidden shadow-2xl">
                                <div class="px-4 py-3 border-b border-white/5 bg-white/[0.02]">
                                    <p class="text-[9px] font-black text-gray-500 uppercase tracking-widest leading-none">Session active</p>
                                    <p class="text-xs font-bold text-emerald-400 mt-1 truncate">{{ Auth::user()->email }}</p>
                                </div>

                                <div class="p-2 space-y-0.5">
                                    <x-dropdown-link href="/profile" class="flex items-center gap-3 rounded-xl py-2.5 text-gray-400 hover:bg-emerald-500/10 hover:text-emerald-400 transition-all border border-transparent hover:border-emerald-500/20">
                                        <svg class="w-4 h-4 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                                        <span class="font-bold text-xs">Mon profil</span>
                                    </x-dropdown-link>

                                    <div class="border-t border-white/5 my-1"></div>

                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <x-dropdown-link href="{{ route('logout') }}"
                                            onclick="event.preventDefault(); this.closest('form').submit();"
                                            class="flex items-center gap-3 rounded-xl py-2.5 text-gray-400 hover:bg-rose-500/10 hover:text-rose-400 transition-all border border-transparent hover:border-rose-500/20">
                                            <svg class="w-4 h-4 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" /></svg>
                                            <span class="font-bold text-xs">Déconnexion</span>
                                        </x-dropdown-link>
                                    </form>
                                </div>
                            </div>
                        </x-slot>
                    </x-dropdown>
                </div>
            </div>
        </div>
    </div>
</nav>
