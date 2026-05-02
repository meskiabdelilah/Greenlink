<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-1.5 h-6 bg-emerald-500 rounded-full shadow-[0_0_10px_#10b981]"></div>
                <h2 class="font-black text-2xl text-white leading-tight uppercase tracking-tighter italic">
                    {{ __('Validation de Mission') }}
                </h2>
            </div>
            <a href="{{ route('agent.dashboard') }}" class="group flex items-center gap-2 text-[10px] font-black text-gray-500 hover:text-white uppercase tracking-[0.2em] transition-all">
                <i class="fas fa-arrow-left group-hover:-translate-x-1 transition-transform"></i>
                Annuler l'Opération
            </a>
        </div>
    </x-slot>

    <div class="py-12 px-4">
        <div class="max-w-2xl mx-auto">

            <div class="relative group overflow-hidden bg-white/[0.02] backdrop-blur-2xl border border-white/10 rounded-[3rem] shadow-2xl">
                {{-- Decorative Glow --}}
                <div class="absolute -top-24 -right-24 w-48 h-48 bg-emerald-500/10 rounded-full blur-[80px]"></div>

                {{-- Header Section --}}
                <div class="bg-emerald-500 px-10 py-8 text-emerald-950 flex justify-between items-center relative overflow-hidden">
                    <div class="absolute inset-0 opacity-10 pointer-events-none" style="background-image: radial-gradient(#000 1px, transparent 1px); background-size: 10px 10px;"></div>
                    <div class="relative z-10">
                        <p class="text-[9px] font-black uppercase tracking-[0.4em] opacity-70 mb-1">Système de Pesée</p>
                        <h1 class="text-2xl font-black italic uppercase tracking-tighter italic leading-none">Rapport Final</h1>
                    </div>
                    <i class="fas fa-weight text-4xl opacity-20"></i>
                </div>

                <div class="p-10">
                    {{-- Info Grid --}}
                    <div class="grid grid-cols-2 gap-6 mb-10 bg-white/[0.03] p-8 rounded-[2rem] border border-white/5 relative">
                        <div class="absolute top-0 right-8 -translate-y-1/2">
                            <span class="px-3 py-1 bg-[#020617] border border-white/10 rounded-full text-[8px] font-black text-emerald-500 uppercase tracking-widest italic">Synchronisation active</span>
                        </div>

                        <div>
                            <p class="text-[9px] font-black text-gray-500 uppercase tracking-widest mb-2 italic">Catégorie Signalée</p>
                            <p class="text-white font-black flex items-center gap-2 tracking-tight italic uppercase">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 shadow-[0_0_5px_#10b981]"></span>
                                {{ $deposit->category?->name ?? 'Standard' }}
                            </p>
                        </div>
                        <div class="text-right">
                            <p class="text-[9px] font-black text-gray-500 uppercase tracking-widest mb-2 italic">Référence Zone</p>
                            <p class="text-white font-black italic">{{ $deposit->city ?? '--' }}</p>
                        </div>
                        <div class="col-span-2 pt-6 border-t border-white/5 mt-2">
                            <div class="flex justify-between items-end">
                                <div>
                                    <p class="text-[9px] font-black text-emerald-500/50 uppercase tracking-widest mb-1 italic font-black">Estimation Citoyen</p>
                                    <p class="text-3xl font-black text-white italic tracking-tighter">{{ $deposit->estimated_weight ?? '0' }} <span class="text-xs font-bold text-gray-600 uppercase">kg</span></p>
                                </div>
                                <i class="fas fa-satellite-dish text-emerald-500/20 text-2xl"></i>
                            </div>
                        </div>
                    </div>

                    {{-- Form --}}
                    <form method="POST" action="{{ route('agent.deposits.validateDeposit', $deposit->id) }}" class="space-y-8">
                        @csrf

                        <div class="text-center">
                            <label for="actual_weight" class="block text-[10px] font-black text-gray-400 mb-6 uppercase tracking-[0.3em] italic">
                                Saisir le poids réel
                            </label>

                            <div class="relative max-w-[260px] mx-auto group">
                                {{-- Input Glow Effect --}}
                                <div class="absolute -inset-1 bg-emerald-500/20 rounded-3xl blur opacity-0 group-focus-within:opacity-100 transition-all duration-500"></div>

                                <input type="number" id="actual_weight" name="actual_weight" step="0.1" required autofocus
                                    class="relative block w-full px-6 py-6 bg-[#020617] border-2 border-white/10 rounded-3xl text-5xl font-black text-center text-white focus:ring-0 focus:border-emerald-500 transition-all italic tracking-tighter"
                                    placeholder="0.0">

                                <div class="absolute inset-y-0 right-0 flex items-center pr-8 pointer-events-none">
                                    <span class="text-emerald-500 font-black text-xl italic uppercase">kg</span>
                                </div>
                            </div>

                            <p class="text-gray-600 text-[9px] mt-6 font-black uppercase tracking-widest italic">
                                <i class="fas fa-info-circle mr-1"></i> Conversion automatique en GreenPoints
                            </p>
                        </div>

                        <button type="submit" class="w-full bg-emerald-500 hover:bg-emerald-400 text-emerald-950 font-black py-5 px-8 rounded-2xl transition-all shadow-[0_10px_30px_-10px_rgba(16,185,129,0.5)] flex justify-center items-center gap-4 text-xs uppercase tracking-[0.3em] group">
                            <span>Confirmer la transaction</span>
                            <i class="fas fa-check-double group-hover:scale-125 transition-transform"></i>
                        </button>
                    </form>
                </div>
            </div>

            {{-- Warning Box (Tactical Style) --}}
            <div class="mt-8 flex items-start gap-5 px-8 py-6 bg-amber-500/[0.03] rounded-[2rem] border border-amber-500/10 shadow-sm relative overflow-hidden group">
                <div class="absolute top-0 left-0 w-1 h-full bg-amber-500/50"></div>
                <div class="bg-amber-500/10 rounded-xl p-3 shrink-0 text-amber-500">
                    <i class="fas fa-shield-alt text-xl"></i>
                </div>
                <div class="text-[10px] text-gray-500 leading-relaxed uppercase tracking-widest font-black italic">
                    <p class="text-amber-500 mb-1">Protocole de sécurité Agent</p>
                    <p class="opacity-60">Veuillez double-vérifier le poids saisi. Toute validation est <span class="text-white underline">définitive</span> et impacte directement le solde du citoyen.</p>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
