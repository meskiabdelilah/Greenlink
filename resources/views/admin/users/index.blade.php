<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-1.5 h-6 bg-emerald-500 rounded-full shadow-[0_0_10px_#10b981]"></div>
                <h2 class="font-black text-2xl text-white uppercase tracking-tighter italic">
                    {{ __('Registre des Unités') }}
                </h2>
            </div>
            <button class="bg-emerald-500 hover:bg-emerald-400 text-emerald-950 px-6 py-2 rounded-xl text-xs font-black uppercase tracking-widest transition-all">
                + Nouvelle Unité
            </button>
        </div>
    </x-slot>

    <div class="py-12 px-4">
        <div class="max-w-7xl mx-auto">
            
            <div class="relative bg-white/[0.02] backdrop-blur-xl border border-white/10 rounded-[2.5rem] overflow-hidden shadow-2xl">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-white/[0.03] text-[10px] text-emerald-500/50 uppercase tracking-[0.3em] border-b border-white/5 italic">
                                <th class="px-8 py-6 font-black">ID Source</th>
                                <th class="px-8 py-6 font-black">Identité</th>
                                <th class="px-8 py-6 font-black">Niveau d'Accès</th>
                                <th class="px-8 py-6 font-black">Statut Système</th>
                                <th class="px-8 py-6 font-black text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-white/5">
                            @foreach($users as $user)
                            <tr class="hover:bg-white/[0.02] transition-all group/row">
                                <td class="px-8 py-5">
                                    <span class="text-xs font-mono text-gray-500 group-hover/row:text-emerald-400 transition-colors">
                                        #UID-{{ str_pad($user->id, 4, '0', STR_PAD_LEFT) }}
                                    </span>
                                </td>
                                <td class="px-8 py-5">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-emerald-500/20 to-blue-500/20 border border-white/10 flex items-center justify-center font-black text-white text-xs">
                                            {{ substr($user->name, 0, 2) }}
                                        </div>
                                        <div class="flex flex-col">
                                            <span class="text-sm font-black text-white italic">{{ $user->name }}</span>
                                            <span class="text-[10px] text-gray-500">{{ $user->email }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-8 py-5">
                                    @php
                                        $roleColor = match($user->role) {
                                            'admin' => 'text-rose-400 bg-rose-400/5 border-rose-400/20',
                                            'agent' => 'text-amber-400 bg-amber-400/5 border-amber-400/20',
                                            default => 'text-emerald-400 bg-emerald-400/5 border-emerald-400/20',
                                        };
                                    @endphp
                                    <span class="px-3 py-1 rounded-lg border text-[9px] font-black uppercase tracking-widest {{ $roleColor }}">
                                        {{ $user->role }}
                                    </span>
                                </td>
                                <td class="px-8 py-5">
                                    @if($user->is_banned)
                                        <span class="flex items-center gap-2 text-[10px] font-bold text-rose-400 uppercase tracking-tighter">
                                            <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span>
                                            Suspendu
                                        </span>
                                    @elseif($user->role === 'agent' && ! $user->is_verified)
                                        <span class="flex items-center gap-2 text-[10px] font-bold text-amber-400 uppercase tracking-tighter">
                                            <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span>
                                            KYC attente
                                        </span>
                                    @else
                                        <span class="flex items-center gap-2 text-[10px] font-bold text-gray-400 uppercase tracking-tighter">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                                            Actif
                                        </span>
                                    @endif
                                </td>
                                <td class="px-8 py-5 text-right">
                                    <a href="{{ route('admin.users.show', $user->id) }}" class="inline-flex items-center justify-center w-9 h-9 rounded-xl bg-white/5 text-gray-400 hover:bg-emerald-500 hover:text-emerald-950 transition-all">
                                        <i class="fas fa-fingerprint"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
