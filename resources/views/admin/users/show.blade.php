<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.users.index') }}" class="text-gray-500 hover:text-white transition-colors">
                <i class="fas fa-arrow-left"></i>
            </a>
            <h2 class="font-black text-2xl text-white uppercase tracking-tighter italic">
                Dossier de l'Unité <span class="text-emerald-500">#{{ $user->id }}</span>
            </h2>
        </div>
    </x-slot>

    <div class="py-12 px-4">
        <div class="max-w-5xl mx-auto space-y-6">
            
            {{-- En-tête utilisateur --}}
            <div class="bg-white/[0.02] backdrop-blur-xl border border-white/10 rounded-[3rem] p-10 relative overflow-hidden">
                <div class="absolute top-0 right-0 p-8">
                    <i class="fas fa-shield-alt text-6xl text-white/[0.02]"></i>
                </div>

                <div class="flex flex-col md:flex-row items-center gap-8 relative z-10">
                    <div class="w-32 h-32 rounded-[2rem] bg-emerald-500/10 border-2 border-emerald-500/20 flex items-center justify-center text-4xl text-emerald-500 font-black shadow-[0_0_30px_rgba(16,185,129,0.1)]">
                        {{ substr($user->name, 0, 1) }}
                    </div>
                    
                    <div class="text-center md:text-left space-y-2">
                        <div class="flex items-center gap-3">
                            <h1 class="text-4xl font-black text-white italic tracking-tighter">{{ $user->name }}</h1>
                            @if($user->is_banned)
                                <span class="px-3 py-1 bg-rose-500 text-white text-[10px] font-black uppercase rounded-lg">Suspendu</span>
                            @elseif(! $user->is_verified)
                                <span class="px-3 py-1 bg-amber-500 text-amber-950 text-[10px] font-black uppercase rounded-lg">KYC en attente</span>
                            @else
                                <span class="px-3 py-1 bg-emerald-500 text-emerald-950 text-[10px] font-black uppercase rounded-lg">Vérifié</span>
                            @endif
                        </div>
                        <p class="text-gray-400 font-mono">{{ $user->email }}</p>
                        <div class="flex gap-4 pt-2">
                            <div class="text-center px-4 py-2 bg-white/5 rounded-2xl border border-white/5">
                                <p class="text-[9px] text-gray-500 uppercase font-black">Solde Points</p>
                                <p class="text-xl font-black text-emerald-400">{{ $user->points ?? '0' }}</p>
                            </div>
                            <div class="text-center px-4 py-2 bg-white/5 rounded-2xl border border-white/5">
                                <p class="text-[9px] text-gray-500 uppercase font-black">Missions</p>
                                <p class="text-xl font-black text-white">{{ $user->deposits_count ?? '0' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Grid Details --}}
            <div class="grid grid-cols-1 md:grid-cols-1 gap-6">
                {{-- Paramètres de sécurité --}}
                <div class="bg-white/[0.02] border border-white/10 rounded-[2.5rem] p-8">
                    <h3 class="text-emerald-500 text-xs font-black uppercase tracking-[0.2em] mb-6 flex items-center gap-2">
                        <i class="fas fa-lock text-[10px]"></i> Paramètres Sécurité
                    </h3>
                    <div class="space-y-4 text-sm">
                        <div class="flex justify-between py-3 border-b border-white/5">
                            <span class="text-gray-500">Rôle Système</span>
                            <span class="text-white font-bold uppercase italic text-xs">{{ $user->role }}</span>
                        </div>
                        <div class="flex justify-between py-3 border-b border-white/5">
                            <span class="text-gray-500">Date d'Enrôlement</span>
                            <span class="text-white font-bold text-xs">{{ $user->created_at?->format('d/m/Y') ?? '--' }}</span>
                        </div>
                        <form action="{{ route('admin.users.toggle-ban', $user) }}" method="POST" class="pt-4 flex">
                            @csrf
                            @method('PATCH')
                            <button
                                type="submit"
                                class="flex-1 {{ $user->is_banned ? 'bg-emerald-500/10 hover:bg-emerald-500 text-emerald-400 hover:text-emerald-950' : 'bg-rose-500/10 hover:bg-rose-500 text-rose-500 hover:text-white' }} py-3 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all"
                                onclick="return confirm('{{ $user->is_banned ? 'Réactiver cet utilisateur ?' : 'Suspendre cet utilisateur ?' }}')"
                            >
                                {{ $user->is_banned ? 'Réactiver' : 'Suspendre' }}
                            </button>
                        </form>
                        @if($user->role === 'agent')
                        <form action="{{ route('admin.users.toggle-verify', $user) }}" method="POST" class="pt-2 flex">
                            @csrf
                            @method('PATCH')
                            <button
                                type="submit"
                                class="flex-1 {{ $user->is_verified ? 'bg-amber-500/10 hover:bg-amber-500 text-amber-400 hover:text-amber-950' : 'bg-emerald-500/10 hover:bg-emerald-500 text-emerald-400 hover:text-emerald-950' }} py-3 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all"
                                onclick="return confirm('{{ $user->is_verified ? 'Retirer la validation agent ?' : 'Valider cet agent ?' }}')"
                            >
                                {{ $user->is_verified ? 'Retirer KYC' : 'Valider agent' }}
                            </button>
                        </form>
                        @endif
                    </div>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>
