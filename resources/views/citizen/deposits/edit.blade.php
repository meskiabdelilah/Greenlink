<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-1.5 h-6 bg-amber-500 rounded-full shadow-[0_0_10px_#f59e0b]"></div>
                <div>
                    <h2 class="font-black text-2xl text-white leading-tight uppercase tracking-tighter italic">
                        {{ __('Modifier les Paramètres') }}
                    </h2>
                    <p class="text-[9px] font-black text-amber-500/60 uppercase tracking-[0.3em]">
                        Référence Système: #GL-{{ str_pad($deposit->id, 5, '0', STR_PAD_LEFT) }}
                    </p>
                </div>
            </div>
            
            <a href="{{ route('citizen.deposits.index') }}" class="group flex items-center gap-2 text-[10px] font-black text-gray-400 hover:text-white transition-all uppercase tracking-[0.2em] bg-white/5 px-5 py-2.5 rounded-xl border border-white/5 hover:border-amber-500/30">
                <i class="fas fa-arrow-left transition-transform group-hover:-translate-x-1"></i>
                Annuler
            </a>
        </div>
    </x-slot>

    <div class="py-12 px-4">
        <div class="max-w-3xl mx-auto">
            <div class="relative group">
                <div class="absolute -inset-1 bg-gradient-to-r from-amber-500/20 to-emerald-500/20 rounded-[2.5rem] blur opacity-25 group-hover:opacity-40 transition duration-1000"></div>
                
                <div class="relative bg-white/[0.02] backdrop-blur-2xl border border-white/10 overflow-hidden shadow-2xl rounded-[2.5rem]">
                    
                    <form action="{{ route('citizen.deposits.update', $deposit->id) }}" method="POST" class="p-8 md:p-12 space-y-8">
                        @csrf
                        @method('PUT')

                        <div class="relative">
                            <label class="block text-[10px] font-black text-amber-400 uppercase tracking-[0.3em] mb-3 ml-1">Mise à jour de la catégorie</label>
                            <div class="relative">
                                <select name="category_id" class="w-full bg-[#0f172a]/50 border-white/5 @error('category_id') border-rose-500/50 @enderror focus:border-amber-500/50 focus:ring-0 text-white rounded-2xl py-4 px-5 transition-all appearance-none cursor-pointer font-bold">
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id', $deposit->category_id) == $category->id ? 'selected' : '' }} class="bg-[#0f172a]">
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="absolute right-5 top-1/2 -translate-y-1/2 pointer-events-none text-gray-500">
                                    <i class="fas fa-chevron-down"></i>
                                </div>
                            </div>
                            @error('category_id') <p class="mt-2 text-[10px] text-rose-400 font-bold uppercase tracking-wider">{{ $message }}</p> @enderror
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div>
                                <label class="block text-[10px] font-black text-amber-400 uppercase tracking-[0.3em] mb-3 ml-1">Rectification Masse (KG)</label>
                                <div class="relative">
                                    <input type="number" name="estimated_weight" step="0.1" value="{{ old('estimated_weight', $deposit->estimated_weight) }}" 
                                        class="w-full bg-[#0f172a]/50 border-white/5 @error('estimated_weight') border-rose-500/50 @enderror focus:border-amber-500/50 focus:ring-0 text-white rounded-2xl py-4 px-5 transition-all font-bold">
                                    <div class="absolute right-5 top-1/2 -translate-y-1/2 text-amber-500/30 font-black italic">KG</div>
                                </div>
                                @error('estimated_weight') <p class="mt-2 text-[10px] text-rose-400 font-bold uppercase tracking-wider">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label class="block text-[10px] font-black text-amber-400 uppercase tracking-[0.3em] mb-3 ml-1">Zone de Transfert</label>
                                <div class="relative">
                                    <input type="text" name="city" value="{{ old('city', $deposit->city) }}" 
                                        class="w-full bg-[#0f172a]/50 border-white/5 @error('city') border-rose-500/50 @enderror focus:border-amber-500/50 focus:ring-0 text-white rounded-2xl py-4 px-5 transition-all font-bold">
                                    <i class="fas fa-location-arrow absolute right-5 top-1/2 -translate-y-1/2 text-amber-500/30"></i>
                                </div>
                                @error('city') <p class="mt-2 text-[10px] text-rose-400 font-bold uppercase tracking-wider">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <div>
                            <label class="block text-[10px] font-black text-amber-400 uppercase tracking-[0.3em] mb-3 ml-1">Nouvelles Coordonnées</label>
                            <textarea name="address" rows="3" class="w-full bg-[#0f172a]/50 border-white/5 @error('address') border-rose-500/50 @enderror focus:border-amber-500/50 focus:ring-0 text-white rounded-2xl py-4 px-5 transition-all resize-none font-medium italic leading-relaxed">{{ old('address', $deposit->address) }}</textarea>
                            @error('address') <p class="mt-2 text-[10px] text-rose-400 font-bold uppercase tracking-wider">{{ $message }}</p> @enderror
                        </div>

                        <div class="pt-6">
                            <button type="submit" class="w-full inline-flex items-center justify-center px-10 py-5 bg-gradient-to-r from-amber-500 to-orange-500 hover:from-amber-400 hover:to-orange-400 text-amber-950 rounded-2xl font-black text-xs uppercase tracking-[0.2em] transition-all duration-300 shadow-[0_10px_30px_-10px_rgba(245,158,11,0.5)] active:scale-95 group/btn">
                                <i class="fas fa-sync-alt mr-3 group-hover/btn:rotate-180 transition-transform duration-500"></i>
                                Appliquer les modifications
                            </button>
                        </div>

                    </form>

                    <div class="bg-black/20 px-8 py-4 border-t border-white/5 flex items-center justify-center gap-3">
                        <i class="fas fa-shield-alt text-[10px] text-amber-500/50"></i>
                        <p class="text-[9px] text-gray-500 font-black uppercase tracking-widest">
                            Modification autorisée uniquement pour le statut "En Attente"
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>