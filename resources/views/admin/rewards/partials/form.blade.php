<div class="grid grid-cols-1 md:grid-cols-2 gap-8 relative z-10">
    <div class="space-y-2 md:col-span-2">
        <label class="text-[10px] font-black text-emerald-500 uppercase tracking-[0.2em] italic ml-2">Titre de la récompense</label>
        <input type="text" name="title" required value="{{ old('title', $voucher?->title) }}" placeholder="ex: Bon d'achat écologique"
            class="w-full bg-[#020617] border border-white/10 rounded-2xl py-4 px-6 text-white text-sm focus:border-emerald-500 focus:ring-0 transition-all placeholder:text-gray-700">
        @error('title')
            <p class="text-rose-400 text-xs font-bold ml-2">{{ $message }}</p>
        @enderror
    </div>

    <div class="space-y-2">
        <label class="text-[10px] font-black text-emerald-500 uppercase tracking-[0.2em] italic ml-2">Coût en GreenPoints</label>
        <input type="number" name="points_required" min="1" step="1" required value="{{ old('points_required', $voucher?->points_required) }}" placeholder="250"
            class="w-full bg-[#020617] border border-white/10 rounded-2xl py-4 px-6 text-white text-sm focus:border-emerald-500 focus:ring-0 transition-all placeholder:text-gray-700">
        @error('points_required')
            <p class="text-rose-400 text-xs font-bold ml-2">{{ $message }}</p>
        @enderror
    </div>

    <div class="space-y-2">
        <label class="text-[10px] font-black text-emerald-500 uppercase tracking-[0.2em] italic ml-2">Stock disponible</label>
        <input type="number" name="stock" min="0" step="1" required value="{{ old('stock', $voucher?->stock) }}" placeholder="20"
            class="w-full bg-[#020617] border border-white/10 rounded-2xl py-4 px-6 text-white text-sm focus:border-emerald-500 focus:ring-0 transition-all placeholder:text-gray-700">
        @error('stock')
            <p class="text-rose-400 text-xs font-bold ml-2">{{ $message }}</p>
        @enderror
    </div>
</div>

<div class="space-y-2 relative z-10">
    <label class="text-[10px] font-black text-emerald-500 uppercase tracking-[0.2em] italic ml-2">Description</label>
    <textarea name="description" rows="4" placeholder="Décrivez les conditions d'utilisation et la valeur de la récompense..."
        class="w-full bg-[#020617] border border-white/10 rounded-3xl py-4 px-6 text-white text-sm focus:border-emerald-500 focus:ring-0 transition-all placeholder:text-gray-700">{{ old('description', $voucher?->description) }}</textarea>
    @error('description')
        <p class="text-rose-400 text-xs font-bold ml-2">{{ $message }}</p>
    @enderror
</div>

<div class="pt-4 flex gap-4 relative z-10">
    <button type="submit" class="flex-1 bg-emerald-500 hover:bg-emerald-400 text-emerald-950 font-black py-4 rounded-2xl text-[11px] uppercase tracking-[0.3em] transition-all shadow-[0_15px_30px_-10px_rgba(16,185,129,0.3)]">
        {{ $submitLabel }}
    </button>
    <a href="{{ route('admin.rewards.index') }}" class="px-8 flex items-center justify-center bg-white/5 text-gray-400 font-black py-4 rounded-2xl text-[11px] uppercase tracking-[0.2em] border border-white/10 hover:bg-white/10 transition-all">
        Annuler
    </a>
</div>
