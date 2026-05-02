<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.deposits.index') }}" class="text-gray-500 hover:text-white transition-colors">
                <i class="fas fa-chevron-left"></i>
            </a>
            <h2 class="font-black text-2xl text-white uppercase tracking-tighter italic">
                Analyse Transaction <span class="text-emerald-500">#{{ $deposit->id }}</span>
            </h2>
        </div>
    </x-slot>

    <div class="py-12 px-4">
        <div class="max-w-6xl mx-auto grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            {{-- Main Info --}}
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-white/[0.02] border border-white/10 rounded-[2.5rem] p-10 relative overflow-hidden">
                    <div class="absolute -top-10 -right-10 w-40 h-40 bg-emerald-500/5 rounded-full blur-3xl"></div>
                    
                    <div class="flex justify-between items-start mb-10">
                        <div>
                            <p class="text-[10px] font-black text-emerald-500 uppercase tracking-[0.3em] mb-2 italic">Catégorie</p>
                            <h3 class="text-4xl font-black text-white italic tracking-tighter">{{ $deposit->category?->name ?? 'Standard' }}</h3>
                        </div>
                        <div class="text-right">
                            <p class="text-[10px] font-black text-gray-500 uppercase tracking-[0.3em] mb-2 italic">Date Opération</p>
                            <p class="text-white font-mono text-sm">{{ $deposit->created_at?->format('d M Y - H:i') ?? '--' }}</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-12">
                        <div class="space-y-4">
                            <div class="flex flex-col">
                                <span class="text-[10px] text-gray-500 uppercase font-black tracking-widest mb-1">Poids Estimé</span>
                                <span class="text-2xl font-black text-white italic">{{ $deposit->estimated_weight }} <small class="text-xs text-emerald-500">KG</small></span>
                            </div>
                            <div class="flex flex-col">
                                <span class="text-[10px] text-gray-500 uppercase font-black tracking-widest mb-1">Poids Réel</span>
                                <span class="text-2xl font-black text-emerald-400 italic">{{ $deposit->actual_weight ?? 'En cours' }} <small class="text-xs">KG</small></span>
                            </div>
                        </div>
                        <div class="p-6 bg-white/[0.03] rounded-3xl border border-white/5">
                            <span class="text-[10px] text-emerald-500 uppercase font-black tracking-widest mb-3 block italic">Points Générés</span>
                            <div class="flex items-center gap-3">
                                <span class="text-4xl font-black text-white tracking-tighter italic">+{{ $deposit->pointTransaction->points ?? '0' }}</span>
                                <i class="fas fa-star text-emerald-500 text-xl shadow-[0_0_15px_rgba(16,185,129,0.5)]"></i>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Location & Notes --}}
                <div class="bg-[#020617] border border-white/10 rounded-[2.5rem] p-8">
                    <h4 class="text-xs font-black text-white uppercase tracking-widest mb-6 flex items-center gap-2 italic">
                        <i class="fas fa-map-marker-alt text-emerald-500"></i> Localisation du Dépôt
                    </h4>
                    <p class="text-gray-400 text-sm leading-relaxed italic bg-white/5 p-4 rounded-2xl border border-white/5">
                        {{ $deposit->address }}, {{ $deposit->city }}
                    </p>
                </div>
            </div>

            {{-- Participants Sidebar --}}
            <div class="space-y-6">
                {{-- Citizen Card --}}
                <div class="bg-white/[0.02] border border-white/10 rounded-[2.5rem] p-6">
                    <p class="text-[9px] font-black text-gray-500 uppercase tracking-[0.3em] mb-4 italic">Émetteur du Flux</p>
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-full bg-emerald-500/10 flex items-center justify-center font-black text-emerald-500 border border-emerald-500/20">
                            {{ substr($deposit->citizen?->name ?? 'C', 0, 1) }}
                        </div>
                        <div class="flex flex-col">
                            <span class="text-sm font-black text-white">{{ $deposit->citizen?->name ?? 'Citoyen supprime' }}</span>
                            <span class="text-[10px] text-gray-500 uppercase font-bold tracking-tighter italic">Citoyen</span>
                        </div>
                    </div>
                </div>

                {{-- Agent Card --}}
                <div class="bg-white/[0.02] border border-white/10 rounded-[2.5rem] p-6">
                    <p class="text-[9px] font-black text-gray-500 uppercase tracking-[0.3em] mb-4 italic">Intercepteur (Agent)</p>
                    @if($deposit->agent)
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-full bg-amber-500/10 flex items-center justify-center font-black text-amber-500 border border-amber-500/20">
                            {{ substr($deposit->agent?->name ?? 'A', 0, 1) }}
                        </div>
                        <div class="flex flex-col">
                            <span class="text-sm font-black text-white">{{ $deposit->agent?->name ?? 'Agent supprime' }}</span>
                            <span class="text-[10px] text-amber-500 uppercase font-bold tracking-tighter italic">Agent de Collecte</span>
                        </div>
                    </div>
                    @else
                    <div class="py-4 text-center border-2 border-dashed border-white/5 rounded-2xl">
                        <span class="text-[9px] font-black text-gray-700 uppercase italic tracking-widest">En attente d'interception</span>
                    </div>
                    @endif
                </div>

                {{-- Actions système --}}
                <div class="pt-6">
                    <button class="w-full bg-rose-500/10 hover:bg-rose-500 text-rose-500 hover:text-white py-4 rounded-2xl text-[10px] font-black uppercase tracking-[0.2em] transition-all border border-rose-500/20 mb-3">
                        Révoquer Transaction
                    </button>
                    <button class="w-full bg-white/5 hover:bg-white/10 text-white py-4 rounded-2xl text-[10px] font-black uppercase tracking-[0.2em] transition-all border border-white/10">
                        Exporter Log PDF
                    </button>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
