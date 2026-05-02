<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-1.5 h-6 bg-emerald-500 rounded-full shadow-[0_0_10px_#10b981]"></div>
                <h2 class="font-black text-2xl text-white leading-tight uppercase tracking-tighter italic">
                    {{ __('Missions Actives') }}
                </h2>
            </div>
            <div class="px-4 py-1 bg-emerald-500/10 border border-emerald-500/20 rounded-full">
                <span class="text-[10px] font-black text-emerald-500 uppercase tracking-widest animate-pulse">
                    ● En Direct
                </span>
            </div>
        </div>
    </x-slot>

    <div class="py-12 px-4">
        <div class="max-w-7xl mx-auto">

            {{-- Terminal Alert --}}
            <div class="mb-8 flex items-center gap-4 px-6 py-4 bg-white/[0.02] border-l-4 border-emerald-500 rounded-r-2xl">
                <i class="fas fa-info-circle text-emerald-500"></i>
                <p class="text-[11px] text-gray-400 font-medium uppercase tracking-wider">
                    Agent, vous avez <span class="text-white font-black">{{ $deposits->count() }} mission(s)</span> en attente de pesée.
                </p>
            </div>

            {{-- Grille des missions actives --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                @forelse($deposits as $deposit)
                <div class="relative group bg-white/[0.02] backdrop-blur-xl border border-white/10 rounded-[2.5rem] overflow-hidden hover:border-emerald-500/30 transition-all duration-500 shadow-2xl">

                    {{-- Top Bar --}}
                    <div class="flex justify-between items-start p-8 pb-0">
                        <div class="flex flex-col">
                            <span class="text-[10px] font-mono text-emerald-500/50 tracking-widest">#OP-{{ str_pad($deposit->id, 5, '0', STR_PAD_LEFT) }}</span>
                            <h3 class="text-xl font-black text-white italic uppercase tracking-tighter mt-1">{{ $deposit->category?->name ?? 'Standard' }}</h3>
                        </div>
                        <div class="px-3 py-1 bg-emerald-500 text-emerald-950 text-[9px] font-black uppercase tracking-widest rounded-lg">
                            En Cours
                        </div>
                    </div>

                    {{-- Details --}}
                    <div class="p-8 space-y-6">
                        <div class="grid grid-cols-2 gap-4">
                            <div class="space-y-1">
                                <p class="text-[9px] font-black text-gray-500 uppercase tracking-widest italic font-black">Estimation</p>
                                <p class="text-white font-bold">{{ $deposit->estimated_weight ?? '0' }} <span class="text-[10px] text-emerald-500">KG</span></p>
                            </div>
                            <div class="space-y-1">
                                <p class="text-[9px] font-black text-gray-500 uppercase tracking-widest italic font-black">Secteur</p>
                                <p class="text-white font-bold uppercase">{{ $deposit->city ?? '--' }}</p>
                            </div>
                        </div>

                        <div class="p-4 bg-white/[0.03] rounded-2xl border border-white/5 group-hover:border-emerald-500/20 transition-colors">
                            <p class="text-[9px] font-black text-emerald-500/50 uppercase tracking-widest mb-2 italic">Point de Collecte</p>
                            <p class="text-xs text-gray-300 leading-relaxed font-medium italic">
                                <i class="fas fa-map-marker-alt mr-2 text-emerald-500"></i>
                                {{ $deposit->address ?? '--' }}
                            </p>
                        </div>

                        {{-- Action Button --}}
                        <div class="pt-4 flex gap-3">
                            <a href="{{ route('agent.deposits.validate', $deposit->id) }}" class="flex-1 bg-emerald-500 hover:bg-emerald-400 text-emerald-950 font-black py-4 rounded-2xl text-[11px] uppercase tracking-[0.2em] transition-all text-center shadow-[0_10px_20px_-10px_rgba(16,185,129,0.4)] flex items-center justify-center gap-2">
                                <i class="fas fa-balance-scale"></i>
                                Lancer la Pesée
                            </a>

                            {{-- Optional: Map Button --}}
                            <a href="https://maps.google.com/?q={{ urlencode($deposit->address) }}" target="_blank" class="w-14 bg-white/5 hover:bg-white/10 text-white rounded-2xl flex items-center justify-center border border-white/10 transition-all group/map">
                                <i class="fas fa-directions text-lg group-hover/map:scale-110 transition-transform"></i>
                            </a>
                        </div>
                    </div>

                    {{-- Background Decoration --}}
                    <div class="absolute -bottom-12 -right-12 w-32 h-32 bg-emerald-500/5 rounded-full blur-3xl"></div>
                </div>
                @empty
                <div class="col-span-full py-32 bg-white/[0.01] border border-dashed border-white/10 rounded-[3rem] flex flex-col items-center justify-center text-center">
                    <div class="w-20 h-20 bg-white/5 rounded-full flex items-center justify-center mb-6">
                        <i class="fas fa-box-open text-3xl text-gray-700"></i>
                    </div>
                    <h3 class="text-gray-500 font-black uppercase tracking-[0.3em] text-sm italic">Aucune mission assignée</h3>
                    <p class="text-gray-600 text-[10px] mt-2 uppercase tracking-widest">Consultez le radar pour accepter de nouveaux objectifs.</p>
                    <a href="{{ route('agent.dashboard') }}" class="mt-8 text-emerald-500 font-black text-[10px] uppercase tracking-widest border-b border-emerald-500/30 hover:border-emerald-500 transition-all">
                        Ouvrir le Radar →
                    </a>
                </div>
                @endforelse
            </div>

        </div>
    </div>
</x-app-layout>
