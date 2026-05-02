<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <div class="w-1.5 h-6 bg-emerald-500 rounded-full shadow-[0_0_10px_#10b981]"></div>
            <h2 class="font-black text-2xl text-white leading-tight uppercase tracking-tighter italic">
                {{ __('Initialiser un nouveau dépôt') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12 px-4">
        <div class="max-w-3xl mx-auto">
            <div class="relative group">
                <div class="absolute -inset-1 bg-gradient-to-r from-emerald-500/20 to-teal-500/20 rounded-[2.5rem] blur opacity-25 group-hover:opacity-50 transition duration-1000"></div>
                
                <div class="relative bg-white/[0.02] backdrop-blur-2xl border border-white/10 overflow-hidden shadow-2xl rounded-[2.5rem]">
                    <div class="p-8 md:p-12">
                        
                        <form method="POST" action="{{ route('citizen.deposits.store') }}" enctype="multipart/form-data" class="space-y-8">
                            @csrf

                            <div class="relative">
                                <label class="block text-[10px] font-black text-emerald-400 uppercase tracking-[0.3em] mb-3 ml-1">Protocole de catégorie</label>
                                <div class="relative">
                                    <select name="category_id" class="w-full bg-[#0f172a]/50 border-white/5 @error('category_id') border-rose-500/50 @enderror focus:border-emerald-500/50 focus:ring-0 text-white rounded-2xl py-4 px-5 transition-all appearance-none cursor-pointer">
                                        <option value="" disabled {{ old('category_id') ? '' : 'selected' }} class="bg-[#0f172a]">Sélectionnez la nature des déchets...</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }} class="bg-[#0f172a] text-white">
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="absolute right-5 top-1/2 -translate-y-1/2 pointer-events-none text-gray-500">
                                        <i class="fas fa-chevron-down"></i>
                                    </div>
                                </div>
                                @error('category_id') <p class="mt-2 ml-1 text-[10px] text-rose-400 font-bold uppercase tracking-wider">{{ $message }}</p> @enderror
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                <div>
                                    <label class="block text-[10px] font-black text-emerald-400 uppercase tracking-[0.3em] mb-3 ml-1">Masse Estimée (KG)</label>
                                    <div class="relative">
                                        <input type="number" name="estimated_weight" step="0.1" value="{{ old('estimated_weight') }}" placeholder="0.00" 
                                            class="w-full bg-[#0f172a]/50 border-white/5 @error('estimated_weight') border-rose-500/50 @enderror focus:border-emerald-500/50 focus:ring-0 text-white rounded-2xl py-4 px-5 transition-all placeholder:text-gray-700">
                                        <div class="absolute right-5 top-1/2 -translate-y-1/2 text-emerald-500/30 font-black italic">KG</div>
                                    </div>
                                    @error('estimated_weight') <p class="mt-2 ml-1 text-[10px] text-rose-400 font-bold uppercase tracking-wider">{{ $message }}</p> @enderror
                                </div>

                                <div>
                                    <label class="block text-[10px] font-black text-emerald-400 uppercase tracking-[0.3em] mb-3 ml-1">Zone de Collecte (Ville)</label>
                                    <div class="relative">
                                        <input type="text" name="city" value="{{ old('city') }}" placeholder="Ex: Tanger" 
                                            class="w-full bg-[#0f172a]/50 border-white/5 @error('city') border-rose-500/50 @enderror focus:border-emerald-500/50 focus:ring-0 text-white rounded-2xl py-4 px-5 transition-all placeholder:text-gray-700">
                                        <i class="fas fa-location-dot absolute right-5 top-1/2 -translate-y-1/2 text-emerald-500/30"></i>
                                    </div>
                                    @error('city') <p class="mt-2 ml-1 text-[10px] text-rose-400 font-bold uppercase tracking-wider">{{ $message }}</p> @enderror
                                </div>
                            </div>

                            <div>
                                <label class="block text-[10px] font-black text-emerald-400 uppercase tracking-[0.3em] mb-3 ml-1">Coordonnées Précises</label>
                                <textarea name="address" rows="3" placeholder="Indiquez l'adresse exacte pour l'agent de collecte..." 
                                    class="w-full bg-[#0f172a]/50 border-white/5 @error('address') border-rose-500/50 @enderror focus:border-emerald-500/50 focus:ring-0 text-white rounded-2xl py-4 px-5 transition-all placeholder:text-gray-700 resize-none">{{ old('address') }}</textarea>
                                @error('address') <p class="mt-2 ml-1 text-[10px] text-rose-400 font-bold uppercase tracking-wider">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label class="block text-[10px] font-black text-emerald-400 uppercase tracking-[0.3em] mb-3 ml-1">Photo du depot</label>
                                <input type="file" name="photo" accept="image/*"
                                    class="w-full bg-[#0f172a]/50 border border-white/5 @error('photo') border-rose-500/50 @enderror focus:border-emerald-500/50 focus:ring-0 text-white rounded-2xl py-4 px-5 transition-all file:mr-4 file:rounded-xl file:border-0 file:bg-emerald-500 file:px-4 file:py-2 file:text-xs file:font-black file:uppercase file:text-emerald-950">
                                @error('photo') <p class="mt-2 ml-1 text-[10px] text-rose-400 font-bold uppercase tracking-wider">{{ $message }}</p> @enderror
                            </div>

                            <div class="flex flex-col sm:flex-row items-center justify-end mt-12 gap-6">
                                <a href="{{ route('citizen.deposits.index') }}" class="text-[10px] font-black text-gray-500 hover:text-white uppercase tracking-[0.2em] transition-colors">
                                    <i class="fas fa-times mr-2"></i> Annuler
                                </a>
                                
                                <button type="submit" class="w-full sm:w-auto inline-flex items-center justify-center px-10 py-5 bg-emerald-500 hover:bg-emerald-400 text-emerald-950 rounded-2xl font-black text-xs uppercase tracking-[0.2em] transition-all duration-300 shadow-[0_10px_30px_-10px_rgba(16,185,129,0.5)] active:scale-95 group/btn">
                                    <i class="fas fa-paper-plane mr-3 group-hover/btn:translate-x-1 group-hover/btn:-translate-y-1 transition-transform"></i>
                                    Enregistrer le dépôt
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
