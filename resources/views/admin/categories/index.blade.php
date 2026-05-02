<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-1.5 h-6 bg-emerald-500 rounded-full shadow-[0_0_10px_#10b981]"></div>
                <h2 class="font-black text-2xl text-white uppercase tracking-tighter italic">
                    {{ __('Configuration des Flux') }}
                </h2>
            </div>
            <a href="{{ route('admin.categories.create') }}" class="bg-emerald-500 hover:bg-emerald-400 text-emerald-950 px-6 py-2 rounded-xl text-[10px] font-black uppercase tracking-[0.2em] transition-all shadow-[0_10px_20px_-10px_rgba(16,185,129,0.4)]">
                + Nouveau Flux
            </a>
        </div>
    </x-slot>

    <div class="py-12 px-4">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($categories as $category)
                <div class="group relative bg-white/[0.02] border border-white/10 rounded-[2.5rem] p-8 hover:border-emerald-500/30 transition-all duration-500 overflow-hidden">
                    {{-- ID & Icon decoration --}}
                    <div class="absolute -top-4 -right-4 w-24 h-24 bg-emerald-500/5 rounded-full blur-2xl group-hover:bg-emerald-500/10 transition-all"></div>
                    
                    <div class="flex justify-between items-start mb-6 relative z-10">
                        <div class="p-4 bg-emerald-500/10 rounded-2xl border border-emerald-500/20 group-hover:scale-110 transition-transform duration-500">
                            <i class="fas fa-recycle text-emerald-500 text-xl"></i>
                        </div>
                        <span class="text-[9px] font-mono text-gray-600 uppercase tracking-widest">Type-{{ str_pad($category->id, 2, '0', STR_PAD_LEFT) }}</span>
                    </div>

                    <h3 class="text-xl font-black text-white italic uppercase tracking-tighter mb-2">{{ $category->name }}</h3>
                    <p class="text-gray-500 text-xs leading-relaxed mb-6 line-clamp-2 italic font-medium">
                        {{ $category->description ?? 'Aucune description technique spécifiée pour ce flux de déchets.' }}
                    </p>

                    <div class="flex items-center justify-between p-4 bg-white/[0.03] rounded-2xl border border-white/5 mb-6">
                        <span class="text-[10px] font-black text-gray-500 uppercase tracking-widest italic">Valeur / KG</span>
                        <div class="flex items-center gap-2">
                            <span class="text-xl font-black text-emerald-400">{{ $category->points_per_kg }}</span>
                            <span class="text-[9px] text-emerald-500/50 font-black uppercase">PTS</span>
                        </div>
                    </div>

                    <div class="flex gap-3 relative z-10">
                        <a href="{{ route('admin.categories.edit', $category->id) }}" class="flex-1 bg-white/5 hover:bg-white/10 text-white py-3 rounded-xl text-[10px] font-black uppercase tracking-widest text-center border border-white/5 transition-all">
                            Modifier
                        </a>
                        <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" class="inline">
                            @csrf @method('DELETE')
                            <button class="px-4 py-3 bg-rose-500/5 hover:bg-rose-500 text-rose-500 hover:text-white rounded-xl text-[10px] transition-all border border-rose-500/10" onclick="return confirm('Confirmer la suppression ?')">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
