<x-app-layout>
    <div class="space-y-8 pb-10 px-4">

        <div class="flex flex-col xl:flex-row xl:items-end justify-between gap-6">
            <div>
                <div class="flex items-center gap-3 mb-2">
                    <div class="w-2 h-8 bg-emerald-500 rounded-full shadow-[0_0_15px_#10b981]"></div>
                    <h1 class="text-4xl font-black text-white tracking-tighter uppercase italic">Mes Récompenses</h1>
                </div>
                <p class="text-gray-500 text-sm font-medium tracking-wide">
                    Échangez vos GreenPoints contre des récompenses disponibles et suivez votre historique.
                </p>
            </div>

            <div class="flex flex-wrap items-center gap-3">
                <a href="{{ route('citizen.deposits.create') }}"
                    class="group relative inline-flex items-center gap-3 bg-emerald-500 text-emerald-950 px-7 py-4 rounded-2xl font-black text-xs uppercase tracking-[0.2em] transition-all duration-500 hover:scale-105 hover:shadow-[0_0_30px_rgba(16,185,129,0.3)] overflow-hidden">
                    <span class="absolute inset-0 bg-white/20 translate-x-[-100%] group-hover:translate-x-[100%] transition-transform duration-700"></span>
                    <i class="fas fa-plus-circle relative z-10"></i>
                    <span class="relative z-10">Gagner plus</span>
                </a>
            </div>
        </div>

        @if(session('success'))
        <div class="bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 px-6 py-4 rounded-[2rem] flex items-center gap-4 shadow-2xl">
            <div class="bg-emerald-500/20 rounded-full p-2">
                <i class="fas fa-check text-sm"></i>
            </div>
            <p class="font-bold text-sm uppercase tracking-wider">{{ session('success') }}</p>
        </div>
        @endif

        @if($errors->any())
        <div class="bg-rose-500/10 border border-rose-500/20 text-rose-400 px-6 py-4 rounded-[2rem] flex items-center gap-4 shadow-2xl">
            <div class="bg-rose-500/20 rounded-full p-2">
                <i class="fas fa-circle-exclamation text-sm"></i>
            </div>
            <p class="font-bold text-sm uppercase tracking-wider">{{ $errors->first() }}</p>
        </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white/[0.03] backdrop-blur-2xl p-7 rounded-[2rem] border border-white/5 shadow-2xl overflow-hidden">
                <div class="flex items-center justify-between gap-4">
                    <div>
                        <p class="text-gray-500 text-[10px] font-black uppercase tracking-[0.3em]">Solde</p>
                        <div class="flex items-baseline gap-2 mt-3">
                            <h2 class="text-5xl font-black text-white tracking-tighter">{{ number_format((float) $pointsBalance, 0) }}</h2>
                            <span class="text-lg text-emerald-400 font-black italic">GP</span>
                        </div>
                    </div>
                    <div class="w-14 h-14 bg-emerald-500/10 rounded-2xl flex items-center justify-center text-emerald-400 border border-emerald-500/20">
                        <i class="fas fa-coins text-2xl"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white/[0.03] backdrop-blur-2xl p-7 rounded-[2rem] border border-white/5 shadow-2xl overflow-hidden">
                <div class="flex items-center justify-between gap-4">
                    <div>
                        <p class="text-gray-500 text-[10px] font-black uppercase tracking-[0.3em]">Échangés</p>
                        <div class="flex items-baseline gap-2 mt-3">
                            <h2 class="text-5xl font-black text-white tracking-tighter">{{ number_format((float) $totalRedeemed, 0) }}</h2>
                            <span class="text-lg text-cyan-400 font-black italic">GP</span>
                        </div>
                    </div>
                    <div class="w-14 h-14 bg-cyan-500/10 rounded-2xl flex items-center justify-center text-cyan-400 border border-cyan-500/20">
                        <i class="fas fa-ticket text-2xl"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white/[0.03] backdrop-blur-2xl p-7 rounded-[2rem] border border-white/5 shadow-2xl overflow-hidden">
                <div class="flex items-center justify-between gap-4">
                    <div>
                        <p class="text-gray-500 text-[10px] font-black uppercase tracking-[0.3em]">Disponibles</p>
                        <div class="flex items-baseline gap-2 mt-3">
                            <h2 class="text-5xl font-black text-white tracking-tighter">{{ $availableRewards }}</h2>
                            <span class="text-lg text-violet-400 font-black italic">Récompenses</span>
                        </div>
                    </div>
                    <div class="w-14 h-14 bg-violet-500/10 rounded-2xl flex items-center justify-center text-violet-400 border border-violet-500/20">
                        <i class="fas fa-gift text-2xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <section class="space-y-5">
            <div class="flex items-center justify-between gap-4">
                <div>
                    <h2 class="text-2xl font-black text-white tracking-tighter uppercase italic">Catalogue des récompenses</h2>
                    <p class="text-gray-500 text-xs font-bold mt-1 uppercase tracking-widest">Utilisez vos points sur les récompenses disponibles</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
                @forelse($vouchers as $voucher)
                    @php
                        $canRedeem = $voucher->stock > 0 && $pointsBalance >= $voucher->points_required;
                        $progress = $voucher->points_required > 0
                            ? min(100, ((float) $pointsBalance / (float) $voucher->points_required) * 100)
                            : 100;
                        $missingPoints = max(0, (float) $voucher->points_required - (float) $pointsBalance);
                    @endphp

                    <article class="bg-white/[0.03] backdrop-blur-2xl border border-white/5 rounded-[2rem] p-7 shadow-2xl transition-all duration-300 hover:border-emerald-500/20">
                        <div class="flex items-start justify-between gap-5">
                            <div class="min-w-0">
                                <p class="text-[9px] font-black uppercase tracking-[0.3em] text-emerald-400 mb-3">Récompense</p>
                                <h3 class="text-xl font-black text-white tracking-tight leading-snug break-words">{{ $voucher->title }}</h3>
                            </div>
                            <div class="shrink-0 w-12 h-12 rounded-2xl bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 flex items-center justify-center">
                                <i class="fas fa-award"></i>
                            </div>
                        </div>

                        <p class="mt-5 text-sm text-gray-400 leading-relaxed min-h-[3.25rem]">
                            {{ $voucher->description ?: 'Une récompense GreenLink prête à être échangée avec vos points.' }}
                        </p>

                        <div class="mt-6 flex items-center justify-between gap-4">
                            <div>
                                <p class="text-[9px] text-gray-600 font-black uppercase tracking-[0.25em]">Coût</p>
                                <p class="text-2xl font-black text-white tracking-tighter mt-1">
                                    {{ number_format((float) $voucher->points_required, 0) }}
                                    <span class="text-sm text-emerald-400 italic">GP</span>
                                </p>
                            </div>

                            <div class="text-right">
                                <p class="text-[9px] text-gray-600 font-black uppercase tracking-[0.25em]">Stock</p>
                                <p class="text-sm font-black mt-2 {{ $voucher->stock > 0 ? 'text-cyan-400' : 'text-rose-400' }}">
                                    {{ $voucher->stock > 0 ? $voucher->stock . ' restant(s)' : 'Épuisé' }}
                                </p>
                            </div>
                        </div>

                        <div class="mt-6">
                            <div class="h-2 rounded-full bg-white/[0.04] overflow-hidden">
                                <div class="h-full rounded-full bg-emerald-500 transition-all duration-500" style="width: {{ $progress }}%"></div>
                            </div>
                            <div class="flex justify-between mt-2 text-[10px] font-black uppercase tracking-wider">
                                <span class="text-gray-600">Votre progression</span>
                                <span class="{{ $canRedeem ? 'text-emerald-400' : 'text-gray-500' }}">
                                    {{ number_format($progress, 0) }}%
                                </span>
                            </div>
                        </div>

                        <form method="POST" action="{{ route('citizen.rewards.redeem', $voucher) }}" class="mt-7">
                            @csrf
                            <button type="submit"
                                @disabled(!$canRedeem)
                                class="w-full inline-flex items-center justify-center gap-3 px-5 py-4 rounded-2xl font-black text-xs uppercase tracking-[0.18em] transition-all {{ $canRedeem ? 'bg-emerald-500 text-emerald-950 hover:scale-[1.02] hover:shadow-[0_0_30px_rgba(16,185,129,0.25)]' : 'bg-white/[0.04] text-gray-600 cursor-not-allowed border border-white/5' }}">
                                <i class="fas {{ $canRedeem ? 'fa-bolt' : 'fa-lock' }}"></i>
                                @if($canRedeem)
                                    Échanger
                                @elseif($voucher->stock < 1)
                                    Stock épuisé
                                @else
                                    Il manque {{ number_format($missingPoints, 0) }} GP
                                @endif
                            </button>
                        </form>
                    </article>
                @empty
                    <div class="md:col-span-2 xl:col-span-3 bg-white/[0.02] backdrop-blur-xl border border-white/5 rounded-[2rem] px-8 py-20 text-center shadow-2xl">
                        <i class="fas fa-gift text-6xl text-emerald-500/20 mb-6"></i>
                        <p class="text-gray-500 text-xs font-black uppercase tracking-[0.4em] italic">Aucune récompense disponible pour le moment</p>
                    </div>
                @endforelse
            </div>
        </section>

        <div class="grid grid-cols-1 xl:grid-cols-2 gap-6">
            <section class="bg-white/[0.02] backdrop-blur-xl border border-white/5 rounded-[2rem] shadow-2xl overflow-hidden">
                <div class="p-7 border-b border-white/5">
                    <h2 class="text-xl font-black text-white tracking-tighter uppercase italic">Échanges récents</h2>
                    <p class="text-gray-500 text-xs font-bold mt-1 uppercase tracking-widest">Vos demandes de récompenses</p>
                </div>

                <div class="divide-y divide-white/5">
                    @forelse($redemptions as $redemption)
                        @php
                            $statusConfig = match($redemption->status) {
                                'completed' => ['bg' => 'bg-emerald-500/10', 'text' => 'text-emerald-400', 'label' => 'Terminé'],
                                'cancelled' => ['bg' => 'bg-rose-500/10', 'text' => 'text-rose-400', 'label' => 'Annulé'],
                                default => ['bg' => 'bg-amber-500/10', 'text' => 'text-amber-400', 'label' => 'En attente'],
                            };
                        @endphp

                        <div class="p-6 flex items-center justify-between gap-5 hover:bg-white/[0.02] transition-colors">
                            <div class="min-w-0">
                                <h3 class="text-sm font-black text-white truncate">{{ $redemption->voucher->title ?? 'Récompense' }}</h3>
                                <p class="text-[10px] text-gray-600 font-black uppercase tracking-widest mt-1">
                                    {{ ($redemption->redeemed_at ?? $redemption->created_at)?->format('d M Y') }}
                                </p>
                            </div>
                            <div class="flex items-center gap-3 shrink-0">
                                <span class="text-sm font-black text-white">{{ number_format((float) $redemption->points_spent, 0) }} GP</span>
                                <span class="px-3 py-1.5 rounded-xl text-[9px] font-black uppercase tracking-widest {{ $statusConfig['bg'] }} {{ $statusConfig['text'] }}">
                                    {{ $statusConfig['label'] }}
                                </span>
                            </div>
                        </div>
                    @empty
                        <div class="px-8 py-16 text-center">
                            <i class="fas fa-receipt text-5xl text-emerald-500/20 mb-5"></i>
                            <p class="text-gray-500 text-xs font-black uppercase tracking-[0.3em] italic">Aucune récompense échangée pour le moment</p>
                        </div>
                    @endforelse
                </div>
            </section>

            <section class="bg-white/[0.02] backdrop-blur-xl border border-white/5 rounded-[2rem] shadow-2xl overflow-hidden">
                <div class="p-7 border-b border-white/5">
                    <h2 class="text-xl font-black text-white tracking-tighter uppercase italic">Activité des points</h2>
                    <p class="text-gray-500 text-xs font-bold mt-1 uppercase tracking-widest">Gains GreenPoint récents</p>
                </div>

                <div class="divide-y divide-white/5">
                    @forelse($transactions as $transaction)
                        <div class="p-6 flex items-center justify-between gap-5 hover:bg-white/[0.02] transition-colors">
                            <div class="flex items-center gap-4 min-w-0">
                                <div class="w-11 h-11 rounded-2xl bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 flex items-center justify-center shrink-0">
                                    <i class="fas fa-leaf"></i>
                                </div>
                                <div class="min-w-0">
                                    <h3 class="text-sm font-black text-white truncate">{{ $transaction->deposit->category->name ?? 'Dépôt de recyclage' }}</h3>
                                    <p class="text-[10px] text-gray-600 font-black uppercase tracking-widest mt-1">{{ $transaction->created_at?->format('d M Y') }}</p>
                                </div>
                            </div>
                            <span class="shrink-0 text-emerald-400 font-black">+{{ number_format((float) $transaction->points, 0) }} GP</span>
                        </div>
                    @empty
                        <div class="px-8 py-16 text-center">
                            <i class="fas fa-seedling text-5xl text-emerald-500/20 mb-5"></i>
                            <p class="text-gray-500 text-xs font-black uppercase tracking-[0.3em] italic">Aucune activité de points pour le moment</p>
                        </div>
                    @endforelse
                </div>
            </section>
        </div>
    </div>
</x-app-layout>
