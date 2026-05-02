<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-1.5 h-6 bg-emerald-500 rounded-full shadow-[0_0_10px_#10b981]"></div>
                <h2 class="font-black text-2xl text-white uppercase tracking-tighter italic">
                    Catalogue des Récompenses
                </h2>
            </div>
            <a href="{{ route('admin.rewards.create') }}" class="bg-emerald-500 hover:bg-emerald-400 text-emerald-950 px-6 py-2 rounded-xl text-[10px] font-black uppercase tracking-[0.2em] transition-all shadow-[0_10px_20px_-10px_rgba(16,185,129,0.4)]">
                + Nouvelle récompense
            </a>
        </div>
    </x-slot>

    <div class="py-12 px-4">
        <div class="max-w-7xl mx-auto space-y-6">
            @if(session('success'))
                <div class="bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 px-6 py-4 rounded-[2rem] flex items-center gap-4 shadow-2xl">
                    <i class="fas fa-check"></i>
                    <p class="font-bold text-sm uppercase tracking-wider">{{ session('success') }}</p>
                </div>
            @endif

            @if(session('error'))
                <div class="bg-rose-500/10 border border-rose-500/20 text-rose-400 px-6 py-4 rounded-[2rem] flex items-center gap-4 shadow-2xl">
                    <i class="fas fa-circle-exclamation"></i>
                    <p class="font-bold text-sm uppercase tracking-wider">{{ session('error') }}</p>
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($vouchers as $voucher)
                    <article class="group relative bg-white/[0.02] border border-white/10 rounded-[2.5rem] p-8 hover:border-emerald-500/30 transition-all duration-500 overflow-hidden">
                        <div class="absolute -top-4 -right-4 w-24 h-24 bg-emerald-500/5 rounded-full blur-2xl group-hover:bg-emerald-500/10 transition-all"></div>

                        <div class="flex justify-between items-start mb-6 relative z-10">
                            <div class="p-4 bg-emerald-500/10 rounded-2xl border border-emerald-500/20 group-hover:scale-110 transition-transform duration-500">
                                <i class="fas fa-gift text-emerald-500 text-xl"></i>
                            </div>
                            <span class="text-[9px] font-mono text-gray-600 uppercase tracking-widest">REC-{{ str_pad($voucher->id, 4, '0', STR_PAD_LEFT) }}</span>
                        </div>

                        <h3 class="text-xl font-black text-white italic uppercase tracking-tighter mb-2 break-words">{{ $voucher->title }}</h3>
                        <p class="text-gray-500 text-xs leading-relaxed mb-6 line-clamp-3 italic font-medium min-h-[3rem]">
                            {{ $voucher->description ?: 'Aucune description renseignée pour cette récompense.' }}
                        </p>

                        <div class="grid grid-cols-3 gap-3 mb-6">
                            <div class="bg-white/[0.03] rounded-2xl border border-white/5 p-4">
                                <p class="text-[9px] font-black text-gray-600 uppercase tracking-widest mb-2">Coût</p>
                                <p class="text-lg font-black text-emerald-400">{{ number_format((float) $voucher->points_required, 0) }}</p>
                                <p class="text-[8px] text-emerald-500/50 font-black uppercase">GP</p>
                            </div>
                            <div class="bg-white/[0.03] rounded-2xl border border-white/5 p-4">
                                <p class="text-[9px] font-black text-gray-600 uppercase tracking-widest mb-2">Stock</p>
                                <p class="text-lg font-black {{ $voucher->stock > 0 ? 'text-cyan-400' : 'text-rose-400' }}">{{ $voucher->stock }}</p>
                                <p class="text-[8px] text-gray-600 font-black uppercase">unités</p>
                            </div>
                            <div class="bg-white/[0.03] rounded-2xl border border-white/5 p-4">
                                <p class="text-[9px] font-black text-gray-600 uppercase tracking-widest mb-2">Échanges</p>
                                <p class="text-lg font-black text-white">{{ $voucher->redemptions_count }}</p>
                                <p class="text-[8px] text-gray-600 font-black uppercase">demandes</p>
                            </div>
                        </div>

                        <div class="flex gap-3 relative z-10">
                            <a href="{{ route('admin.rewards.edit', $voucher) }}" class="flex-1 bg-white/5 hover:bg-white/10 text-white py-3 rounded-xl text-[10px] font-black uppercase tracking-widest text-center border border-white/5 transition-all">
                                Modifier
                            </a>
                            <form action="{{ route('admin.rewards.destroy', $voucher) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-4 py-3 bg-rose-500/5 hover:bg-rose-500 text-rose-500 hover:text-white rounded-xl text-[10px] transition-all border border-rose-500/10" onclick="return confirm('Confirmer la suppression de cette récompense ?')">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </div>
                    </article>
                @empty
                    <div class="lg:col-span-3 bg-white/[0.02] border border-white/10 rounded-[2.5rem] p-16 text-center">
                        <i class="fas fa-gift text-6xl text-emerald-500/20 mb-6"></i>
                        <p class="text-gray-500 text-xs font-black uppercase tracking-[0.4em] italic">Aucune récompense configurée</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
