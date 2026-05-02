<x-app-layout>
    <div class="space-y-10 pb-10 px-4">
        
        <div class="relative overflow-hidden rounded-[3.5rem] bg-[#020617] p-8 md:p-14 border border-white/5 shadow-2xl">
            <div class="absolute right-0 top-0 -translate-y-1/2 translate-x-1/2 w-[500px] h-[500px] bg-emerald-500/10 rounded-full blur-[120px] animate-pulse"></div>
            <div class="absolute left-0 bottom-0 translate-y-1/2 -translate-x-1/2 w-80 h-80 bg-teal-500/5 rounded-full blur-[80px]"></div>
            
            <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-8">
                <div>
                    <div class="inline-flex items-center gap-2 px-3 py-1 bg-emerald-500/10 border border-emerald-500/20 rounded-full mb-6">
                        <span class="w-1.5 h-1.5 bg-emerald-400 rounded-full animate-ping"></span>
                        <span class="text-[9px] font-black uppercase tracking-widest text-emerald-400 italic">Protocole Actif</span>
                    </div>
                    <h1 class="text-5xl md:text-6xl font-black text-white tracking-tighter leading-none">
                        Salut, <span class="bg-clip-text text-transparent bg-gradient-to-r from-emerald-400 to-teal-300 italic">{{ auth()->user()->name }}</span>
                    </h1>
                    <p class="mt-6 text-gray-400 font-medium max-w-md leading-relaxed text-lg">
                        Votre impact environnemental est en progression. Continuez à <span class="text-white italic">recycler l'avenir</span>.
                    </p>
                </div>

                <div class="flex shrink-0">
                    <a href="{{route('citizen.deposits.create')}}" class="group relative bg-emerald-500 text-emerald-950 font-black px-10 py-5 rounded-[2rem] transition-all duration-500 hover:scale-105 hover:shadow-[0_20px_40px_-10px_rgba(16,185,129,0.4)] active:scale-95 flex items-center gap-4 overflow-hidden">
                        <div class="absolute inset-0 bg-white/20 translate-x-[-100%] group-hover:translate-x-[100%] transition-transform duration-700"></div>
                        <i class="fas fa-plus-circle text-xl"></i>
                        <span class="uppercase tracking-[0.2em] text-xs">Nouveau Dépôt</span>
                    </a>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            
            <div class="group relative bg-white/[0.03] backdrop-blur-2xl p-8 rounded-[3rem] border border-white/5 hover:border-emerald-500/20 transition-all duration-500 overflow-hidden shadow-2xl">
                <div class="absolute -right-10 -bottom-10 w-32 h-32 bg-emerald-500/5 rounded-full group-hover:scale-150 transition-transform duration-700"></div>
                <div class="relative z-10">
                    <div class="w-14 h-14 bg-emerald-500/10 rounded-2xl flex items-center justify-center text-emerald-400 mb-8 border border-emerald-500/20 group-hover:rotate-12 transition-transform">
                        <i class="fas fa-coins text-2xl"></i>
                    </div>
                    <p class="text-gray-500 text-[10px] font-black uppercase tracking-[0.3em]">Solde GreenPoints</p>
                    <div class="flex items-baseline gap-3 mt-3">
                        <h2 class="text-6xl font-black text-white tracking-tighter">
                            {{ $points ?? 0 }}
                        </h2>
                        <span class="text-xl text-emerald-400 font-bold italic tracking-tighter">GP</span>
                    </div>
                </div>
            </div>

            <div class="group relative bg-white/[0.03] backdrop-blur-2xl p-8 rounded-[3rem] border border-white/5 hover:border-blue-500/20 transition-all duration-500 overflow-hidden shadow-2xl">
                <div class="absolute -right-10 -bottom-10 w-32 h-32 bg-blue-500/5 rounded-full group-hover:scale-150 transition-transform duration-700"></div>
                <div class="relative z-10">
                    <div class="w-14 h-14 bg-blue-500/10 rounded-2xl flex items-center justify-center text-blue-400 mb-8 border border-blue-500/20 group-hover:rotate-12 transition-transform">
                        <i class="fas fa-weight text-2xl"></i>
                    </div>
                    <p class="text-gray-500 text-[10px] font-black uppercase tracking-[0.3em]">Total Recyclé</p>
                    <div class="flex items-baseline gap-3 mt-3">
                        <h2 class="text-6xl font-black text-white tracking-tighter">
                            {{ $totalKg ?? 0 }}
                        </h2>
                        <span class="text-xl text-blue-400 font-bold italic tracking-tighter">KG</span>
                    </div>
                </div>
            </div>

            <div class="group relative bg-white/[0.03] backdrop-blur-2xl p-8 rounded-[3rem] border border-white/5 hover:border-teal-500/20 transition-all duration-500 overflow-hidden shadow-2xl">
                <div class="absolute -right-10 -bottom-10 w-32 h-32 bg-teal-500/5 rounded-full group-hover:scale-150 transition-transform duration-700"></div>
                <div class="relative z-10">
                    <div class="w-14 h-14 bg-teal-500/10 rounded-2xl flex items-center justify-center text-teal-400 mb-8 border border-teal-500/20 group-hover:rotate-12 transition-transform">
                        <i class="fas fa-leaf text-2xl"></i>
                    </div>
                    <p class="text-gray-500 text-[10px] font-black uppercase tracking-[0.3em]">CO₂ Économisé</p>
                    <div class="flex items-baseline gap-3 mt-3">
                        <h2 class="text-6xl font-black text-white tracking-tighter">
                            {{ $co2Saved ?? 0 }}
                        </h2>
                        <span class="text-xl text-teal-400 font-bold italic tracking-tighter">KG</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white/[0.02] backdrop-blur-xl rounded-[3.5rem] border border-white/5 shadow-2xl overflow-hidden">
            <div class="p-10 flex justify-between items-center border-b border-white/5">
                <div>
                    <h3 class="text-2xl font-black text-white tracking-tighter italic uppercase">Flux de Recyclage</h3>
                    <p class="text-gray-500 text-xs font-bold mt-1 uppercase tracking-widest">Temps réel</p>
                </div>
                <a href="{{route('citizen.deposits.index')}}" class="group flex items-center gap-3 px-6 py-3 bg-white/5 rounded-2xl text-[10px] font-black text-gray-400 uppercase tracking-widest hover:bg-emerald-500/10 hover:text-emerald-400 transition-all">
                    Historique Complet <i class="fas fa-arrow-right group-hover:translate-x-1 transition-transform"></i>
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-white/[0.01]">
                            <th class="px-10 py-6 text-[9px] font-black text-gray-500 uppercase tracking-[0.3em]">Temporalité</th>
                            <th class="px-10 py-6 text-[9px] font-black text-gray-500 uppercase tracking-[0.3em]">Type d'énergie</th>
                            <th class="px-10 py-6 text-[9px] font-black text-gray-500 uppercase tracking-[0.3em]">Masse</th>
                            <th class="px-10 py-6 text-[9px] font-black text-gray-500 uppercase tracking-[0.3em] text-center">État du Système</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5">
                        @forelse($deposits ?? [] as $deposit)
                        <tr class="hover:bg-white/[0.02] transition-colors group">
                            <td class="px-10 py-7">
                                <span class="text-sm font-black text-white block">{{ $deposit->created_at?->format('d M') ?? '--' }}</span>
                                <span class="text-[9px] text-emerald-500/50 font-black uppercase tracking-tighter">{{ $deposit->created_at?->format('H:i') ?? '--' }}</span>
                            </td>
                            <td class="px-10 py-7">
                                <span class="px-4 py-2 bg-emerald-500/5 text-emerald-400 border border-emerald-500/10 rounded-xl text-[10px] font-black uppercase tracking-widest group-hover:bg-emerald-500/20 transition-all">
                                    {{ $deposit->category->name ?? 'Standard' }}
                                </span>
                            </td>
                            <td class="px-10 py-7">
                                <span class="text-2xl font-black text-white italic tracking-tighter">{{ $deposit->actual_weight ?? 0 }}</span>
                                <span class="text-[10px] text-gray-600 font-black uppercase ml-1 tracking-widest">kg</span>
                            </td>
                            <td class="px-10 py-7">
                                @if($deposit->status == 'validé')
                                    <div class="flex items-center justify-center gap-2 bg-emerald-500/10 text-emerald-400 px-4 py-2 rounded-2xl border border-emerald-500/20">
                                        <div class="w-1.5 h-1.5 bg-emerald-400 rounded-full shadow-[0_0_8px_#10b981]"></div>
                                        <span class="text-[9px] font-black uppercase tracking-widest">Synchronisé</span>
                                    </div>
                                @else
                                    <div class="flex items-center justify-center gap-2 bg-amber-500/10 text-amber-400 px-4 py-2 rounded-2xl border border-amber-500/20">
                                        <div class="w-1.5 h-1.5 bg-amber-400 rounded-full animate-pulse shadow-[0_0_8px_#fbbf24]"></div>
                                        <span class="text-[9px] font-black uppercase tracking-widest">En Analyse</span>
                                    </div>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-10 py-24 text-center">
                                <div class="opacity-20 mb-6 scale-150">
                                    <i class="fas fa-satellite-dish text-6xl text-emerald-500"></i>
                                </div>
                                <p class="text-gray-500 text-xs font-black uppercase tracking-[0.4em] italic">Aucune donnée détectée dans le réseau</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
