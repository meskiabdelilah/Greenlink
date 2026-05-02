<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <div class="w-1.5 h-6 bg-emerald-500 rounded-full shadow-[0_0_10px_#10b981]"></div>
            <h2 class="font-black text-2xl text-white leading-tight uppercase tracking-tighter italic">
                {{ __('Archives de Collecte') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12 px-4">
        <div class="max-w-7xl mx-auto">

            {{-- Statistiques du tableau de bord --}}
            <div class="mb-10 grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="relative group overflow-hidden bg-white/[0.02] backdrop-blur-xl border border-white/10 p-8 rounded-[2.5rem] shadow-2xl">
                    <div class="absolute -top-10 -right-10 w-32 h-32 bg-emerald-500/10 rounded-full blur-3xl group-hover:bg-emerald-500/20 transition-all duration-700"></div>

                    <p class="text-[10px] font-black text-emerald-500/50 uppercase tracking-[0.3em] mb-2 italic">Solde Total</p>
                    <div class="flex items-end gap-2">
                        <p class="text-4xl font-black text-white tracking-tighter italic">
                            {{ $deposits->sum(fn($d) => $d->pointTransaction->points ?? 0) }}
                        </p>
                        <span class="text-xs font-black text-emerald-500 pb-1 uppercase tracking-widest">Points</span>
                    </div>
                </div>
            </div>

            {{-- Tactical Table Container --}}
            <div class="relative group">
                <div class="absolute -inset-1 bg-emerald-500/5 rounded-[2.5rem] blur opacity-25"></div>

                <div class="relative bg-white/[0.02] backdrop-blur-xl border border-white/10 rounded-[2.5rem] overflow-hidden shadow-2xl">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-white/[0.03] text-[10px] text-emerald-500/50 uppercase tracking-[0.3em] border-b border-white/5 italic">
                                    <th class="px-8 py-6 font-black">Référence</th>
                                    <th class="px-8 py-6 font-black">Catégorie</th>
                                    <th class="px-8 py-6 font-black">Localisation</th>
                                    <th class="px-8 py-6 font-black text-center">Poids Réel</th>
                                    <th class="px-8 py-6 font-black">Statut Mission</th>
                                    <th class="px-8 py-6 font-black text-right">Récompense</th>
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
                                                <i class="fas fa-leaf text-[10px]"></i>
                                            </div>
                                            <span class="text-sm font-black text-white italic tracking-tight italic">{{ $deposit->category?->name ?? 'Standard' }}</span>
                                        </div>
                                    </td>

                                    {{-- Ville --}}
                                    <td class="px-8 py-5">
                                        <span class="text-[11px] text-gray-400 font-bold uppercase tracking-widest italic flex items-center gap-2">
                                            <i class="fas fa-map-marker-alt text-emerald-500/30"></i>
                                            {{ $deposit->city ?? '--' }}
                                        </span>
                                    </td>

                                    {{-- Poids --}}
                                    <td class="px-8 py-5 text-center font-black">
                                        @if($deposit->actual_weight)
                                        <span class="text-white italic tracking-tighter">{{ $deposit->actual_weight }}</span>
                                        <span class="text-[9px] text-gray-600 ml-0.5 uppercase">kg</span>
                                        @else
                                        <span class="text-gray-700">--</span>
                                        @endif
                                    </td>

                                    {{-- Status --}}
                                    <td class="px-8 py-5">
                                        @php
                                        $statusColors = match(strtolower($deposit->status ?? '')) {
                                        'pending', 'en attente' => 'text-amber-500 bg-amber-500/5 border-amber-500/20 shadow-[0_0_10px_rgba(245,158,11,0.1)]',
                                        'validated', 'validé' => 'text-emerald-400 bg-emerald-400/5 border-emerald-400/20 shadow-[0_0_10px_rgba(52,211,153,0.1)]',
                                        'rejected', 'rejeté' => 'text-rose-500 bg-rose-500/5 border-rose-500/20',
                                        default => 'text-gray-400 bg-gray-400/5 border-gray-400/20',
                                        };
                                        @endphp
                                        <span class="inline-flex items-center px-4 py-1 rounded-full text-[9px] font-black uppercase tracking-widest border {{ $statusColors }} italic">
                                            <span class="w-1 h-1 rounded-full bg-current mr-2 animate-pulse"></span>
                                            {{ $deposit->status ?? '--' }}
                                        </span>
                                    </td>

                                    {{-- Points --}}
                                    <td class="px-8 py-5 text-right">
                                        @if($deposit->pointTransaction)
                                        <div class="flex items-center justify-end gap-2">
                                            <span class="text-lg font-black text-emerald-400 italic tracking-tighter">
                                                +{{ $deposit->pointTransaction->points }}
                                            </span>
                                            <div class="w-5 h-5 rounded-full bg-emerald-500/10 flex items-center justify-center text-[10px] text-emerald-500 border border-emerald-500/20">
                                                <i class="fas fa-star"></i>
                                            </div>
                                        </div>
                                        @else
                                        <span class="text-gray-700 font-black tracking-widest italic text-[10px]">EN ATTENTE</span>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="px-8 py-24 text-center">
                                        <div class="flex flex-col items-center">
                                            <i class="fas fa-history text-4xl text-gray-700 mb-4 opacity-20"></i>
                                            <p class="text-gray-500 font-black tracking-[0.2em] uppercase text-xs italic">Aucune donnée archivée</p>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
