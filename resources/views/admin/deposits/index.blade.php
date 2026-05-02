<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-1.5 h-6 bg-emerald-500 rounded-full shadow-[0_0_10px_#10b981]"></div>
                <h2 class="font-black text-2xl text-white uppercase tracking-tighter italic">
                    {{ __('Flux de Collecte Global') }}
                </h2>
            </div>
            <div class="flex gap-2">
                <span class="px-4 py-1 bg-white/5 border border-white/10 rounded-lg text-[10px] font-bold text-gray-400 uppercase tracking-widest">
                    Total : {{ $deposits->count() }}
                </span>
            </div>
        </div>
    </x-slot>

    <div class="py-12 px-4">
        <div class="max-w-7xl mx-auto">
            
            <div class="relative bg-white/[0.02] backdrop-blur-xl border border-white/10 rounded-[2.5rem] overflow-hidden shadow-2xl">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-white/[0.03] text-[10px] text-emerald-500/50 uppercase tracking-[0.3em] border-b border-white/5 italic">
                                <th class="px-8 py-6 font-black">Référence Ops</th>
                                <th class="px-8 py-6 font-black">Émetteur (Citoyen)</th>
                                <th class="px-8 py-6 font-black">Agent Assigné</th>
                                <th class="px-8 py-6 font-black text-center">Volume (KG)</th>
                                <th class="px-8 py-6 font-black">État</th>
                                <th class="px-8 py-6 font-black text-right">Analyse</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-white/5">
                            @foreach($deposits as $deposit)
                            <tr class="hover:bg-emerald-500/[0.02] transition-all group/row">
                                {{-- ID --}}
                                <td class="px-8 py-5">
                                    <span class="text-xs font-mono text-gray-500 group-hover/row:text-emerald-400 transition-colors">
                                        #TRX-{{ str_pad($deposit->id, 6, '0', STR_PAD_LEFT) }}
                                    </span>
                                </td>

                                {{-- Utilisateur --}}
                                <td class="px-8 py-5">
                                    <div class="flex flex-col">
                                        <span class="text-sm font-black text-white italic">{{ $deposit->citizen?->name ?? 'Citoyen supprime' }}</span>
                                        <span class="text-[9px] text-gray-600 uppercase tracking-tighter italic">{{ $deposit->city ?? '--' }}</span>
                                    </div>
                                </td>

                                {{-- Agent --}}
                                <td class="px-8 py-5">
                                    @if($deposit->agent)
                                        <div class="flex items-center gap-2">
                                            <div class="w-2 h-2 rounded-full bg-amber-500 shadow-[0_0_5px_#f59e0b]"></div>
                                            <span class="text-xs font-bold text-amber-500/80">{{ $deposit->agent?->name ?? 'Agent supprime' }}</span>
                                        </div>
                                    @else
                                        <span class="text-[9px] font-black text-gray-700 uppercase tracking-widest italic border border-white/5 px-2 py-1 rounded">Non Assigné</span>
                                    @endif
                                </td>

                                {{-- Poids --}}
                                <td class="px-8 py-5 text-center">
                                    <span class="text-sm font-black text-white italic">
                                        {{ $deposit->actual_weight ?? $deposit->estimated_weight ?? '0' }}
                                    </span>
                                    <span class="text-[9px] text-emerald-500 font-bold ml-0.5">KG</span>
                                </td>

                                {{-- Status --}}
                                <td class="px-8 py-5">
                                    @php
                                        $statusStyles = match(strtolower($deposit->status ?? '')) {
                                            'pending'=> 'text-amber-500 bg-amber-500/5 border-amber-500/20',
                                            'validated' => 'text-emerald-400 bg-emerald-400/5 border-emerald-400/20',
                                            'rejected' => 'text-rose-500 bg-rose-500/5 border-rose-500/20',
                                            default => 'text-gray-400 bg-white/5 border-white/10',
                                        };
                                    @endphp
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-[9px] font-black uppercase tracking-widest border {{ $statusStyles }}">
                                        {{ $deposit->status ?? '--' }}
                                    </span>
                                </td>

                                {{-- Action --}}
                                <td class="px-8 py-5 text-right">
                                    <a href="{{ route('admin.deposits.show', $deposit->id) }}" class="text-gray-500 hover:text-emerald-400 transition-colors">
                                        <i class="fas fa-external-link-alt text-sm"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
