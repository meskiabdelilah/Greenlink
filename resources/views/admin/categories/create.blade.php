<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.categories.index') }}" class="text-gray-500 hover:text-white transition-colors">
                <i class="fas fa-arrow-left"></i>
            </a>
            <h2 class="font-black text-2xl text-white uppercase tracking-tighter italic">Initialiser Nouveau Flux</h2>
        </div>
    </x-slot>

    <div class="py-12 px-4">
        <div class="max-w-3xl mx-auto">
            <form action="{{ route('admin.categories.store') }}" method="POST" class="bg-white/[0.02] backdrop-blur-xl border border-white/10 rounded-[3rem] p-10 space-y-8 relative overflow-hidden">
                <div class="absolute inset-0 bg-grainy opacity-5 pointer-events-none"></div>
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    {{-- Nom --}}
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-emerald-500 uppercase tracking-[0.2em] italic ml-2">Désignation du Matériau</label>
                        <input type="text" name="name" required value="{{ old('name') }}" placeholder="ex: Plastique PET"
                            class="w-full bg-[#020617] border border-white/10 rounded-2xl py-4 px-6 text-white text-sm focus:border-emerald-500 focus:ring-0 transition-all placeholder:text-gray-700">
                        @error('name')
                            <p class="text-rose-400 text-xs font-bold ml-2">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Points per KG --}}
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-emerald-500 uppercase tracking-[0.2em] italic ml-2">Ratio Points / KG</label>
                        <input type="number" name="points_per_kg" step="0.01" min="0" required value="{{ old('points_per_kg') }}" placeholder="10.00"
                            class="w-full bg-[#020617] border border-white/10 rounded-2xl py-4 px-6 text-white text-sm focus:border-emerald-500 focus:ring-0 transition-all placeholder:text-gray-700">
                        @error('points_per_kg')
                            <p class="text-rose-400 text-xs font-bold ml-2">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-emerald-500 uppercase tracking-[0.2em] italic ml-2">CO2 economise / KG</label>
                        <input type="number" name="co2_saved_per_kg" step="0.01" min="0" required value="{{ old('co2_saved_per_kg') }}" placeholder="2.50"
                            class="w-full bg-[#020617] border border-white/10 rounded-2xl py-4 px-6 text-white text-sm focus:border-emerald-500 focus:ring-0 transition-all placeholder:text-gray-700">
                        @error('co2_saved_per_kg')
                            <p class="text-rose-400 text-xs font-bold ml-2">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Description --}}
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-emerald-500 uppercase tracking-[0.2em] italic ml-2">Spécifications Techniques</label>
                    <textarea name="description" rows="4" placeholder="Décrivez les conditions d'acceptation..."
                        class="w-full bg-[#020617] border border-white/10 rounded-3xl py-4 px-6 text-white text-sm focus:border-emerald-500 focus:ring-0 transition-all placeholder:text-gray-700">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="text-rose-400 text-xs font-bold ml-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="pt-4 flex gap-4">
                    <button type="submit" class="flex-1 bg-emerald-500 hover:bg-emerald-400 text-emerald-950 font-black py-4 rounded-2xl text-[11px] uppercase tracking-[0.3em] transition-all shadow-[0_15px_30px_-10px_rgba(16,185,129,0.3)]">
                        Enregistrer dans la Base
                    </button>
                    <a href="{{ route('admin.categories.index') }}" class="px-8 flex items-center justify-center bg-white/5 text-gray-400 font-black py-4 rounded-2xl text-[11px] uppercase tracking-[0.2em] border border-white/10 hover:bg-white/10 transition-all">
                        Annuler
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
