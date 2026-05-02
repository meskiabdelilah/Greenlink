<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-1.5 h-6 bg-blue-500 rounded-full shadow-[0_0_10px_#3b82f6]"></div>
                <h2 class="font-black text-2xl text-white leading-tight uppercase tracking-tighter italic">
                    {{ __('Terminal Agent v1.0') }}
                </h2>
            </div>
            <div class="flex items-center gap-2 px-4 py-1.5 bg-emerald-500/10 border border-emerald-500/20 rounded-full">
                <span class="w-2 h-2 bg-emerald-500 rounded-full animate-pulse"></span>
                <span class="text-[10px] font-black text-emerald-400 uppercase tracking-widest">Système En Ligne</span>
            </div>
        </div>
    </x-slot>

    <div class="py-8 px-4">
        <div class="max-w-7xl mx-auto">
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-12">
                <div class="relative group overflow-hidden bg-white/[0.02] border border-white/10 p-8 rounded-[2.5rem] backdrop-blur-xl">
                    <div class="absolute -right-4 -bottom-4 opacity-10 group-hover:opacity-20 transition-opacity">
                        <i class="fas fa-boxes text-8xl text-blue-500"></i>
                    </div>
                    <p class="text-[10px] font-black text-gray-500 uppercase tracking-[0.3em] mb-2">Flux Global En Attente</p>
                    <div class="flex items-end gap-3">
                        <span class="text-5xl font-black text-white italic tracking-tighter">{{ $pendingCount }}</span>
                        <span class="text-blue-500 text-[10px] font-black mb-2 uppercase tracking-widest">Unités Détectées</span>
                    </div>
                </div>

                <div class="relative group overflow-hidden bg-white/[0.02] border border-white/10 p-8 rounded-[2.5rem] backdrop-blur-xl">
                    <div class="absolute -right-4 -bottom-4 opacity-10 group-hover:opacity-20 transition-opacity">
                        <i class="fas fa-truck-loading text-8xl text-emerald-500"></i>
                    </div>
                    <p class="text-[10px] font-black text-gray-500 uppercase tracking-[0.3em] mb-2">Mes Missions Assignées</p>
                    <div class="flex items-end gap-3">
                        <span class="text-5xl font-black text-white italic tracking-tighter">{{ $assignedCount }}</span>
                        <span class="text-emerald-500 text-[10px] font-black mb-2 uppercase tracking-widest">En Cours</span>
                    </div>
                </div>
            </div>

            <div class="flex items-center gap-4 mb-8 ml-2">
                <i class="fas fa-satellite text-blue-500 animate-bounce"></i>
                <h3 class="text-[11px] font-black text-white uppercase tracking-[0.4em]">Signal de Collecte Direct (Global)</h3>
                <div class="flex-1 h-[1px] bg-gradient-to-r from-white/10 to-transparent"></div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                @forelse($allPending as $deposit)
                    <div class="bg-[#0f172a]/40 border border-white/5 hover:border-blue-500/40 rounded-[2.5rem] transition-all p-8 group">
                        <div class="flex justify-between items-start mb-6">
                            <div>
                                <span class="px-3 py-1 bg-white/5 text-gray-400 border border-white/10 rounded-lg text-[9px] font-black uppercase tracking-widest">Ref: #GL-{{ $deposit->id }}</span>
                                <h4 class="text-white font-black text-xl mt-3 tracking-tighter italic group-hover:text-blue-400 transition-colors">
                                    {{ $deposit->category?->name ?? 'Standard' }}
                                </h4>
                            </div>
                            <div class="bg-blue-500/10 px-4 py-2 rounded-2xl border border-blue-500/20 text-center">
                                <p class="text-[8px] font-black text-blue-500 uppercase tracking-widest">Masse</p>
                                <p class="text-lg font-black text-white italic">{{ $deposit->estimated_weight ?? '0' }}<span class="text-[10px] ml-1">KG</span></p>
                            </div>
                        </div>

                        <div class="space-y-4 mb-8">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-lg bg-blue-500/5 flex items-center justify-center border border-blue-500/10">
                                    <i class="fas fa-map-pin text-blue-500 text-xs"></i>
                                </div>
                                <p class="text-xs text-gray-400 font-medium italic">"{{ $deposit->address ?? '--' }}, {{ $deposit->city ?? '--' }}"</p>
                            </div>
                        </div>

                        <form action="{{ route('agent.deposits.assign', $deposit->id) }}" method="POST">
                            @csrf
                            <button class="w-full py-4 bg-white/5 hover:bg-blue-600 text-white rounded-2xl text-[10px] font-black uppercase tracking-[0.2em] border border-white/10 hover:border-blue-500 transition-all duration-300 shadow-xl flex items-center justify-center gap-3 group/btn">
                                <i class="fas fa-hand-pointer group-hover/btn:scale-125 transition-transform"></i>
                                Prendre en charge cette mission
                            </button>
                        </form>
                    </div>
                @empty
                    <div class="col-span-full py-24 text-center border-2 border-dashed border-white/5 rounded-[3rem]">
                        <p class="text-gray-600 font-black text-[10px] uppercase tracking-[0.4em]">Scan terminé : Aucun dépôt en attente</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
