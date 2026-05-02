<x-app-layout>
    <div class="space-y-8 pb-10 px-4">

        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-6">
            <div>
                <div class="flex items-center gap-3 mb-2">
                    <div class="w-2 h-8 bg-emerald-500 rounded-full shadow-[0_0_15px_#10b981]"></div>
                    <h1 class="text-4xl font-black text-white tracking-tighter uppercase italic">Mes Collectes</h1>
                </div>
                <p class="text-gray-500 text-sm font-medium tracking-wide">Gestion du flux de recyclage et traçabilité des dépôts.</p>
            </div>

            <a href="{{route('citizen.deposits.create')}}" class="group relative flex items-center gap-3 bg-emerald-500 text-emerald-950 px-8 py-4 rounded-2xl font-black text-xs uppercase tracking-[0.2em] transition-all duration-500 hover:scale-105 hover:shadow-[0_0_30px_rgba(16,185,129,0.3)] overflow-hidden">
                <div class="absolute inset-0 bg-white/20 translate-x-[-100%] group-hover:translate-x-[100%] transition-transform duration-700"></div>
                <svg class="w-5 h-5 transition-transform group-hover:rotate-90 duration-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"></path>
                </svg>
                Nouveau Dépôt
            </a>
        </div>

        @if(session('success'))
        <div class="bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 px-6 py-4 rounded-[2rem] flex items-center gap-4 shadow-2xl animate-fade-in">
            <div class="bg-emerald-500/20 rounded-full p-2">
                <svg class="w-5 h-5 shadow-[0_0_10px_#10b981]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>
            <p class="font-bold text-sm uppercase tracking-wider">{{ session('success') }}</p>
        </div>
        @endif

        <div class="bg-white/[0.02] backdrop-blur-xl border border-white/5 rounded-[3.5rem] shadow-2xl overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-separate border-spacing-0">
                    <thead>
                        <tr class="bg-white/[0.03]">
                            <th class="px-8 py-6 text-[10px] font-black text-gray-500 uppercase tracking-[0.3em]">Catégorie / ID</th>
                            <th class="px-8 py-6 text-[10px] font-black text-gray-500 uppercase tracking-[0.3em]">Poids Estimé</th>
                            <th class="px-8 py-6 text-[10px] font-black text-gray-500 uppercase tracking-[0.3em]">Localisation</th>
                            <th class="px-8 py-6 text-[10px] font-black text-gray-500 uppercase tracking-[0.3em]">Statut Système</th>
                            <th class="px-8 py-6 text-[10px] font-black text-gray-500 uppercase tracking-[0.3em] text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5">
                        @forelse($deposits as $deposit)
                        <tr class="hover:bg-white/[0.02] transition-all duration-300 group">
                            <td class="px-8 py-6">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 rounded-2xl bg-white/[0.03] border border-white/5 flex items-center justify-center text-emerald-400 group-hover:scale-110 group-hover:border-emerald-500/30 transition-all duration-500">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <span class="text-sm font-black text-white block tracking-wide uppercase">{{ $deposit->category->name }}</span>
                                        <span class="text-[9px] text-gray-600 font-bold uppercase tracking-widest">#DEP-{{ str_pad($deposit->id, 5, '0', STR_PAD_LEFT) }}</span>
                                    </div>
                                </div>
                            </td>

                            <td class="px-8 py-6">
                                <div class="flex items-baseline gap-1">
                                    <span class="text-xl font-black text-white italic tracking-tighter">{{ $deposit->estimated_weight }}</span>
                                    <span class="text-[10px] text-emerald-500/50 font-black uppercase">kg</span>
                                </div>
                            </td>

                            <td class="px-8 py-6">
                                <div class="flex items-center gap-2 text-gray-400">
                                    <div class="w-1.5 h-1.5 rounded-full bg-emerald-500/30"></div>
                                    <span class="text-xs font-bold uppercase tracking-wider">{{ $deposit->city }}</span>
                                </div>
                            </td>

                            <td class="px-8 py-6">
                                @php
                                $status = strtolower($deposit->status);
                                $config = match($status) {
                                'pending', 'en attente' => ['bg' => 'bg-amber-500/10', 'text' => 'text-amber-400', 'border' => 'border-amber-500/20', 'dot' => 'bg-amber-400', 'label' => 'En Analyse'],
                                'validated', 'validé' => ['bg' => 'bg-emerald-500/10', 'text' => 'text-emerald-400', 'border' => 'border-emerald-500/20', 'dot' => 'bg-emerald-400', 'label' => 'Synchronisé'],
                                'rejected', 'rejeté' => ['bg' => 'bg-rose-500/10', 'text' => 'text-rose-400', 'border' => 'border-rose-500/20', 'dot' => 'bg-rose-400', 'label' => 'Anomalie'],
                                default => ['bg' => 'bg-gray-500/10', 'text' => 'text-gray-400', 'border' => 'border-gray-500/20', 'dot' => 'bg-gray-400', 'label' => $deposit->status],
                                };
                                @endphp
                                <span class="inline-flex items-center gap-2 px-4 py-2 rounded-xl text-[9px] font-black uppercase tracking-[0.15em] border {{ $config['bg'] }} {{ $config['text'] }} {{ $config['border'] }}">
                                    <span class="w-1.5 h-1.5 rounded-full {{ $config['dot'] }} {{ $status == 'pending' ? 'animate-pulse shadow-[0_0_8px_#fbbf24]' : '' }}"></span>
                                    {{ $config['label'] }}
                                </span>
                            </td>

                            <td class="px-8 py-6 text-right">
                                <div class="flex items-center justify-end gap-3">
                                    <a href="{{ route('citizen.deposits.show', $deposit->id) }}"
                                        class="p-2.5 bg-white/[0.03] text-gray-500 hover:text-emerald-400 hover:bg-emerald-500/10 border border-white/5 rounded-xl transition-all"
                                        title="Détails">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </a>

                                    @if(in_array($status, ['pending', 'en attente']))
                                    <a href="{{ route('citizen.deposits.edit', $deposit->id) }}"
                                        class="p-2.5 bg-white/[0.03] text-gray-500 hover:text-blue-400 hover:bg-blue-500/10 border border-white/5 rounded-xl transition-all"
                                        title="Modifier">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </a>

                                    <form method="POST" action="{{ route('citizen.deposits.destroy', $deposit->id) }}" onsubmit="return confirm('Confirmer la suppression ?')" class="inline-block">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="p-2.5 bg-white/[0.03] text-gray-500 hover:text-rose-400 hover:bg-rose-500/10 border border-white/5 rounded-xl transition-all">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-4v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                        </button>
                                    </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-8 py-24 text-center">
                                <div class="opacity-20 mb-6 scale-150">
                                    <i class="fas fa-box-open text-6xl text-emerald-500"></i>
                                </div>
                                <p class="text-gray-500 text-xs font-black uppercase tracking-[0.4em] italic">Aucun dépôt enregistré dans la base</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>