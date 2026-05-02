<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <div class="w-1.5 h-6 bg-emerald-500 rounded-full shadow-[0_0_10px_#10b981]"></div>
            <h2 class="font-black text-2xl text-white leading-tight uppercase tracking-tighter italic">
                {{ __('Objectifs de Collecte') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12 px-4">
        <div class="max-w-7xl mx-auto">

            {{-- Flash Messages (Cyber Style) --}}
            @if(session('success'))
            <div class="mb-8 bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 px-6 py-4 rounded-2xl flex items-center gap-4 animate-fade-in-down">
                <i class="fas fa-check-circle text-xl"></i>
                <p class="font-black text-xs uppercase tracking-widest">{{ session('success') }}</p>
            </div>
            @endif

            @if(session('error'))
            <div class="mb-8 bg-rose-500/10 border border-rose-500/20 text-rose-400 px-6 py-4 rounded-2xl flex items-center gap-4">
                <i class="fas fa-exclamation-triangle text-xl"></i>
                <p class="font-black text-xs uppercase tracking-widest">{{ session('error') }}</p>
            </div>
            @endif

            {{-- Tactical Table Container --}}
            <div class="relative group">
                <div class="absolute -inset-1 bg-emerald-500/5 rounded-[2.5rem] blur opacity-25"></div>

                <div class="relative bg-white/[0.02] backdrop-blur-xl border border-white/10 rounded-[2.5rem] overflow-hidden shadow-2xl">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-white/[0.03] text-[10px] text-emerald-500/50 uppercase tracking-[0.3em] border-b border-white/5 italic">
                                    <th class="px-8 py-6 font-black">Code Unité</th>
                                    <th class="px-8 py-6 font-black">Catégorie</th>
                                    <th class="px-8 py-6 font-black">Secteur / Ville</th>
                                    <th class="px-8 py-6 font-black text-center">Masse Est.</th>
                                    <th class="px-8 py-6 font-black">Localisation</th>
                                    <th class="px-8 py-6 font-black text-right">Statut</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-white/5">
                                @forelse($deposits as $deposit)
                                <tr class="hover:bg-emerald-500/[0.03] transition-all group/row cursor-default">
                                    {{-- Ref ID --}}
                                    <td class="px-8 py-5">
                                        <span class="text-xs font-mono text-gray-500 group-hover/row:text-emerald-400 transition-colors">
                                            #GL-{{ str_pad($deposit->id, 5, '0', STR_PAD_LEFT) }}
                                        </span>
                                    </td>

                                    {{-- Catégorie --}}
                                    <td class="px-8 py-5">
                                        <div class="flex items-center gap-3">
                                            <div class="w-8 h-8 rounded-lg bg-emerald-500/10 flex items-center justify-center text-emerald-500 border border-emerald-500/20 group-hover/row:scale-110 transition-all">
                                                <i class="fas fa-recycle text-[10px]"></i>
                                            </div>
                                            <span class="text-sm font-black text-white italic tracking-tight">{{ $deposit->category?->name ?? 'Standard' }}</span>
                                        </div>
                                    </td>

                                    {{-- Ville --}}
                                    <td class="px-8 py-5">
                                        <span class="inline-flex items-center px-3 py-1 bg-white/5 border border-white/10 text-gray-400 rounded-lg text-[9px] font-black uppercase tracking-widest group-hover/row:border-emerald-500/30 transition-all italic">
                                            <i class="fas fa-map-marker-alt mr-2 text-emerald-500/50"></i>
                                            {{ $deposit->city ?? '--' }}
                                        </span>
                                    </td>

                                    {{-- Poids --}}
                                    <td class="px-8 py-5 text-center">
                                        <div class="flex flex-col">
                                            <span class="text-lg font-black text-white italic tracking-tighter">{{ $deposit->estimated_weight ?? '0' }}</span>
                                            <span class="text-[8px] font-black text-emerald-500/40 uppercase tracking-[0.2em] -mt-1">KG UNIT</span>
                                        </div>
                                    </td>

                                    {{-- Adresse --}}
                                    <td class="px-8 py-5 max-w-[200px]">
                                        <p class="text-[11px] text-gray-500 font-medium italic truncate group-hover/row:text-gray-300 transition-colors">
                                            {{ $deposit->address ?? '--' }}
                                        </p>
                                    </td>

                                    {{-- Action --}}
                                    <td class="px-8 py-5 text-right">
                                        <form method="POST" action="{{ route('agent.deposits.assign', $deposit->id) }}" class="inline-block">
                                            @csrf
                                            <button type="submit" class="group/btn relative px-6 py-2 bg-emerald-500 text-emerald-950 rounded-xl text-[10px] font-black uppercase tracking-[0.2em] hover:bg-emerald-400 transition-all hover:-translate-y-0.5 active:translate-y-0 shadow-[0_5px_15px_-5px_rgba(16,185,129,0.4)]">
                                                Accepter
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="px-8 py-32 text-center">
                                        <div class="flex flex-col items-center">
                                            <div class="relative mb-6">
                                                <div class="absolute inset-0 bg-emerald-500/20 blur-3xl rounded-full"></div>
                                                <i class="fas fa-satellite-dish text-5xl text-gray-700 relative animate-pulse"></i>
                                            </div>
                                            <p class="text-gray-500 font-black tracking-[0.3em] uppercase text-[10px]">Aucun signal de collecte détecté</p>
                                            <p class="text-gray-600 text-[9px] mt-2 italic">Le radar est en mode veille active...</p>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- Table Footer --}}
                    <div class="bg-white/[0.02] px-8 py-4 border-t border-white/5">
                        <div class="flex items-center justify-between">
                            <p class="text-[9px] text-gray-600 font-black uppercase tracking-widest italic flex items-center gap-2">
                                <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full"></span>
                                Système de synchronisation en temps réel
                            </p>
                            <span class="text-[9px] text-gray-700 font-mono">Terminal: v1.0.4-Alpha</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
