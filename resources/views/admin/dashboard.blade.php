<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-1.5 h-6 bg-emerald-500 rounded-full shadow-[0_0_10px_#10b981]"></div>
                <h2 class="font-black text-2xl text-white uppercase tracking-tighter italic">
                    {{ __('Terminal de Commandement') }}
                </h2>
            </div>
            <div class="flex items-center gap-4">
                <span class="flex items-center gap-2 px-4 py-1.5 bg-white/5 border border-white/10 rounded-full text-[9px] font-black text-emerald-400 uppercase tracking-widest animate-pulse">
                    <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full"></span>
                    Systeme Operationnel
                </span>
            </div>
        </div>
    </x-slot>

    <div class="py-12 px-6">
        <div class="max-w-7xl mx-auto space-y-8">
            
            {{-- 1. Metrics Grid --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                
                {{-- Citizens & Agents (Combined logic) --}}
                <div class="group bg-white/[0.02] border border-white/10 p-8 rounded-[2.5rem] hover:border-emerald-500/30 transition-all relative overflow-hidden">
                    <div class="absolute -right-4 -top-4 w-20 h-20 bg-emerald-500/5 rounded-full blur-2xl"></div>
                    <p class="text-[9px] font-black text-gray-500 uppercase tracking-[0.3em] mb-4">Effectif Global</p>
                    <div class="flex items-end justify-between">
                        <h3 class="text-4xl font-black text-white tracking-tighter italic">{{ $totalCitizens + $totalAgents }}</h3>
                        <div class="text-right">
                            <p class="text-[10px] text-emerald-400 font-bold tracking-tighter">{{ $totalCitizens }} citoyens</p>
                            <p class="text-[10px] text-amber-400 font-bold tracking-tighter">{{ $totalAgents }} agents</p>
                        </div>
                    </div>
                </div>

                {{-- Poids des déchets --}}
                <div class="group bg-white/[0.02] border border-white/10 p-8 rounded-[2.5rem] hover:border-blue-500/30 transition-all relative overflow-hidden">
                    <p class="text-[9px] font-black text-gray-500 uppercase tracking-[0.3em] mb-4">Flux de Dechets</p>
                    <div class="flex items-end justify-between">
                        <h3 class="text-4xl font-black text-white tracking-tighter italic">{{ number_format($totalWeight, 1) }}</h3>
                        <span class="text-xs font-black text-blue-500">KG COLLECTÉS</span>
                    </div>
                    <div class="mt-4 h-1 w-full bg-white/5 rounded-full overflow-hidden">
                        <div class="h-full bg-blue-500 w-[75%] shadow-[0_0_10px_#3b82f6]"></div>
                    </div>
                </div>

                {{-- CO2 économisé --}}
                <div class="group bg-white/[0.02] border border-white/10 p-8 rounded-[2.5rem] hover:border-rose-500/30 transition-all relative overflow-hidden">
                    <p class="text-[9px] font-black text-gray-500 uppercase tracking-[0.3em] mb-4">Impact Carbone</p>
                    <div class="flex items-end justify-between">
                        <h3 class="text-4xl font-black text-rose-500 tracking-tighter italic">{{ number_format($totalCO2, 1) }}</h3>
                        <span class="text-[10px] font-black text-rose-500/50 uppercase italic">KG CO2 ÉVITÉS</span>
                    </div>
                    <i class="fas fa-leaf absolute -bottom-2 -right-2 text-rose-500/5 text-6xl"></i>
                </div>

                {{-- Crédits distribués --}}
                <div class="group bg-white/[0.02] border border-white/10 p-8 rounded-[2.5rem] hover:border-emerald-500/30 transition-all relative overflow-hidden">
                    <p class="text-[9px] font-black text-gray-500 uppercase tracking-[0.3em] mb-4">Crédits distribués</p>
                    <div class="flex items-end justify-between">
                        <h3 class="text-4xl font-black text-emerald-400 tracking-tighter italic">{{ number_format($totalPoints) }}</h3>
                        <i class="fas fa-star text-emerald-500/20 text-3xl"></i>
                    </div>
                    <p class="text-[10px] text-gray-600 mt-4 uppercase font-bold tracking-tighter italic">Total des points GreenLink</p>
                </div>
            </div>

            {{-- 2. Visual Analytics --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                {{-- Chart Section --}}
                <div class="lg:col-span-2 bg-[#020617] border border-white/10 rounded-[3rem] p-8 relative overflow-hidden">
                    <div class="absolute inset-0 bg-grainy opacity-5 pointer-events-none"></div>
                    <div class="flex items-center justify-between mb-10 italic">
                        <h3 class="text-sm font-black text-white uppercase tracking-[0.2em]">Flux d'activité <span class="text-emerald-500">en direct</span></h3>
                        <div class="flex items-center gap-4 text-[10px] font-black text-gray-500 uppercase tracking-widest">
                            <span>{{ $categoriesCount }} catégories actives</span>
                        </div>
                    </div>

                    <div class="h-64 flex items-end gap-3 px-4">
                        @foreach([30, 45, 60, 40, 80, 55, 90, 70, 85, 100, 75, 95] as $val)
                            <div class="flex-1 bg-gradient-to-t from-emerald-500/20 to-emerald-500/60 rounded-t-lg transition-all hover:to-emerald-400 cursor-pointer group/bar relative" style="height: {{ $val }}%">
                                <div class="absolute -top-8 left-1/2 -translate-x-1/2 bg-white text-emerald-950 text-[8px] font-black px-1.5 py-0.5 rounded opacity-0 group-hover/bar:opacity-100 transition-opacity">
                                    {{ $val }}%
                                0</div>
                            </div>
                        @endforeach
                    </div>
                    <div class="mt-6 flex justify-between px-2 text-[9px] font-black text-gray-600 uppercase tracking-widest italic">
                        <span>00:00</span><span>06:00</span><span>12:00</span><span>18:00</span><span>23:59</span>
                    </div>
                </div>

                {{-- Informations sur l'état du système --}}
                <div class="bg-white/[0.02] border border-white/10 rounded-[3rem] p-8 flex flex-col justify-between">
                    <div>
                        <h3 class="text-sm font-black text-white uppercase tracking-[0.2em] mb-8 italic">Résumé des données</h3>
                        <div class="space-y-6">
                            <div class="flex justify-between items-center border-b border-white/5 pb-4">
                                <span class="text-[10px] font-black text-gray-500 uppercase">Catégories</span>
                                <span class="text-white font-mono tracking-tighter">{{ $categoriesCount }}</span>
                            </div>
                            <div class="flex justify-between items-center border-b border-white/5 pb-4">
                                <span class="text-[10px] font-black text-gray-500 uppercase">Ratio CO2/KG moyen</span>
                                <span class="text-rose-500 font-mono tracking-tighter">
                                    {{ $totalWeight > 0 ? number_format($totalCO2 / $totalWeight, 2) : 0 }}
                                </span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="p-6 bg-emerald-500/5 rounded-2xl border border-emerald-500/10">
                        <p class="text-[9px] font-black text-emerald-500 uppercase tracking-widest mb-2">Note système</p>
                        <p class="text-[10px] text-gray-400 italic leading-relaxed">
                            Toutes les données sont synchronisées en temps réel avec le noyau central.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<style>
    .bg-grainy {
        background-image: url("https://grainy-gradients.vercel.app/noise.svg");
        filter: contrast(150%) brightness(50%);
    }
</style>
