<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-1.5 h-6 bg-emerald-500 rounded-full shadow-[0_0_10px_#10b981]"></div>
                <h2 class="font-black text-2xl text-white leading-tight uppercase tracking-tighter italic">
                    {{ __('Dossier de Dépôt') }}
                </h2>
            </div>

            <a href="{{ route('citizen.deposits.index') }}" class="group flex items-center gap-2 text-[10px] font-black text-gray-400 hover:text-white transition-all uppercase tracking-[0.2em] bg-white/5 px-5 py-2.5 rounded-xl border border-white/5 hover:border-emerald-500/30">
                <svg class="w-4 h-4 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Retour au flux
            </a>
        </div>
    </x-slot>

    <div class="py-12 px-4">
        <div class="max-w-2xl mx-auto">

            <div class="relative overflow-hidden bg-[#0f172a]/40 backdrop-blur-3xl border border-white/10 rounded-[3rem] shadow-2xl">

                <div class="relative bg-gradient-to-r from-emerald-600/20 to-teal-500/20 px-8 py-6 border-b border-white/5 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                    <div class="z-10">
                        <p class="text-[9px] font-black text-emerald-400 uppercase tracking-[0.4em] mb-1">Identifiant Unique</p>
                        <h3 class="text-white font-black tracking-widest text-lg">#GL-{{ str_pad($deposit->id, 5, '0', STR_PAD_LEFT) }}</h3>
                    </div>

                    @php
                    $status = strtolower($deposit->status);
                    $config = match($status) {
                    'pending', 'en attente' => ['bg' => 'bg-amber-500/10', 'text' => 'text-amber-400', 'border' => 'border-amber-500/20', 'label' => 'En Analyse'],
                    'validated', 'validé' => ['bg' => 'bg-emerald-500/10', 'text' => 'text-emerald-400', 'border' => 'border-emerald-500/20', 'label' => 'Confirmé'],
                    'rejected', 'rejeté' => ['bg' => 'bg-rose-500/10', 'text' => 'text-rose-400', 'border' => 'border-rose-500/20', 'label' => 'Anomalie'],
                    default => ['bg' => 'bg-gray-500/10', 'text' => 'text-gray-400', 'border' => 'border-gray-500/20', 'label' => $deposit->status],
                    };
                    @endphp

                    <div class="z-10 px-5 py-2 rounded-2xl border {{ $config['bg'] }} {{ $config['border'] }} {{ $config['text'] }} flex items-center gap-3">
                        <span class="relative flex h-2 w-2">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-current opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-current"></span>
                        </span>
                        <span class="text-xs font-black uppercase tracking-[0.2em]">{{ $config['label'] }}</span>
                    </div>

                    <div class="absolute top-0 right-0 w-32 h-32 bg-emerald-500/10 blur-[50px] -mr-16 -mt-16"></div>
                </div>

                <div class="p-8 sm:p-12 space-y-10">
                    <div class="grid grid-cols-1 gap-10">

                        <div class="flex items-start gap-6 group">
                            <div class="w-14 h-14 rounded-2xl bg-white/[0.03] border border-white/10 flex items-center justify-center text-emerald-400 shadow-inner transition-transform group-hover:scale-110 duration-500">
                                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4"></path>
                                </svg>
                            </div>
                            <div class="space-y-1">
                                <p class="text-[10px] font-black text-gray-500 uppercase tracking-[0.3em]">Classification</p>
                                <p class="text-xl font-bold text-white tracking-wide">{{ $deposit->category->name }}</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-10">
                            <div class="flex items-start gap-6 group">
                                <div class="w-14 h-14 rounded-2xl bg-white/[0.03] border border-white/10 flex items-center justify-center text-teal-400 group-hover:scale-110 duration-500">
                                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"></path>
                                    </svg>
                                </div>
                                <div class="space-y-1">
                                    <p class="text-[10px] font-black text-gray-500 uppercase tracking-[0.3em]">Masse Nette</p>
                                    <p class="text-xl font-bold text-white italic tracking-tighter">{{ $deposit->estimated_weight }} <span class="text-xs text-teal-500/50 not-italic ml-1">KG</span></p>
                                </div>
                            </div>

                            <div class="flex items-start gap-6 group">
                                <div class="w-14 h-14 rounded-2xl bg-white/[0.03] border border-white/10 flex items-center justify-center text-blue-400 group-hover:scale-110 duration-500">
                                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                </div>
                                <div class="space-y-1">
                                    <p class="text-[10px] font-black text-gray-500 uppercase tracking-[0.3em]">Localisation</p>
                                    <p class="text-xl font-bold text-white tracking-wide">{{ $deposit->city }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="relative p-6 bg-white/[0.02] border border-white/5 rounded-[2rem] group">
                            <div class="flex items-center gap-3 mb-4 text-indigo-400">
                                <i class="fas fa-map-marker-alt text-sm"></i>
                                <p class="text-[10px] font-black uppercase tracking-[0.3em]">Point d'extraction précis</p>
                            </div>
                            <p class="text-gray-300 font-medium leading-relaxed italic">"{{ $deposit->address }}"</p>
                        </div>

                        @if($deposit->photo_path)
                        <div class="relative overflow-hidden rounded-[2rem] border border-white/10 bg-white/[0.02]">
                            <img src="{{ asset('storage/' . $deposit->photo_path) }}" alt="Photo du dépôt" class="w-full max-h-96 object-cover">
                        </div>
                        @endif

                    </div>
                </div>

                <div class="bg-black/20 px-8 py-5 flex justify-between items-center border-t border-white/5">
                    <p class="text-[9px] text-gray-600 font-black tracking-[0.4em] uppercase italic">Flux de données chiffrées</p>
                    <div class="flex gap-2">
                        <div class="w-1 h-1 bg-emerald-500 rounded-full animate-pulse"></div>
                        <div class="w-1 h-1 bg-emerald-500/50 rounded-full animate-pulse delay-75"></div>
                        <div class="w-1 h-1 bg-emerald-500/20 rounded-full animate-pulse delay-150"></div>
                    </div>
                </div>
            </div>

            @if(strtolower($deposit->status) == 'pending' || strtolower($deposit->status) == 'en attente')
            <div class="mt-8 flex justify-center">
                <a href="{{ route('citizen.deposits.edit', $deposit) }}" class="flex items-center gap-3 bg-white/5 hover:bg-white/10 text-white px-8 py-4 rounded-2xl font-black text-[10px] uppercase tracking-[0.2em] border border-white/10 transition-all">
                    <i class="fas fa-edit text-emerald-500"></i>
                    Modifier les paramètres
                </a>
            </div>
            @endif

        </div>
    </div>
</x-app-layout>
