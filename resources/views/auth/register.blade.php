<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center relative px-6 py-12 overflow-hidden bg-[#020617]">
        
        <div class="absolute inset-0 -z-10">
            <div class="absolute top-[-20%] right-[-10%] w-[600px] h-[600px] bg-emerald-500/10 rounded-full blur-[120px]"></div>
            <div class="absolute bottom-[-20%] left-[-10%] w-[500px] h-[500px] bg-teal-900/20 rounded-full blur-[120px]"></div>
            <div class="absolute inset-0 bg-[url('https://grainy-gradients.vercel.app/noise.svg')] opacity-20"></div>
        </div>

        <div class="w-full max-w-[500px] relative">
            
            <div class="text-center mb-8">
                <a href="/" class="inline-block hover:scale-110 transition-transform duration-500">
                    <img src="{{ asset('images/logo.png') }}" class="h-14 w-auto mx-auto brightness-125 drop-shadow-[0_0_15px_rgba(16,185,129,0.3)] scale-[1.7]" alt="Logo GreenLink">
                </a>
                <h2 class="mt-6 text-3xl font-black text-white tracking-tighter uppercase italic">Mission <span class="text-emerald-400">Verte</span></h2>
                <p class="text-gray-500 text-[10px] font-black uppercase tracking-[0.3em] mt-2">Rejoignez l'écosystème GreenLink</p>
            </div>

            <div class="bg-white/[0.03] backdrop-blur-2xl p-8 md:p-10 rounded-[3rem] border border-white/10 shadow-2xl relative">
                
                <form method="POST" action="{{ route('register') }}" class="space-y-5">
                    @csrf

                    <div class="group/field">
                        <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-emerald-500/60 mb-2 ml-1">Nom Complet</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-gray-500 group-focus-within/field:text-emerald-400">
                                <i class="fas fa-user-astronaut"></i>
                            </span>
                            <input type="text" name="name" :value="old('name')" required autofocus 
                                   class="block w-full pl-11 pr-5 py-4 bg-white/[0.05] border border-white/5 rounded-2xl focus:border-emerald-500/30 focus:ring-4 focus:ring-emerald-500/10 focus:bg-white/[0.08] transition-all outline-none text-white font-bold placeholder:text-gray-600"
                                   placeholder="Ex: Omar Green">
                        </div>
                        <x-input-error :messages="$errors->get('name')" class="mt-1 text-[10px] text-red-400 uppercase font-bold" />
                    </div>

                    <div class="group/field">
                        <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-emerald-500/60 mb-2 ml-1">Adresse e-mail</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-gray-500 group-focus-within/field:text-emerald-400">
                                <i class="fas fa-envelope"></i>
                            </span>
                            <input type="email" name="email" :value="old('email')" required 
                                   class="block w-full pl-11 pr-5 py-4 bg-white/[0.05] border border-white/5 rounded-2xl focus:border-emerald-500/30 focus:ring-4 focus:ring-emerald-500/10 focus:bg-white/[0.08] transition-all outline-none text-white font-bold placeholder:text-gray-600"
                                   placeholder="votre@email.com">
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-1 text-[10px] text-red-400 uppercase font-bold" />
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="group/field">
                            <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-emerald-500/60 mb-2 ml-1">Téléphone</label>
                            <input type="text" name="phone" value="{{ old('phone') }}" required
                                   class="block w-full px-5 py-4 bg-white/[0.05] border border-white/5 rounded-2xl focus:border-emerald-500/30 focus:ring-4 focus:ring-emerald-500/10 focus:bg-white/[0.08] transition-all outline-none text-white font-bold"
                                   placeholder="+212 600 000 000">
                            <x-input-error :messages="$errors->get('phone')" class="mt-1 text-[10px] text-red-400 uppercase font-bold" />
                        </div>

                        <div class="group/field">
                            <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-emerald-500/60 mb-2 ml-1">Rôle</label>
                            <select name="role" required
                                    class="block w-full px-5 py-4 bg-white/[0.05] border border-white/5 rounded-2xl focus:border-emerald-500/30 focus:ring-4 focus:ring-emerald-500/10 focus:bg-white/[0.08] transition-all outline-none text-white font-bold">
                                <option value="citizen" class="bg-[#020617]" {{ old('role') === 'citizen' ? 'selected' : '' }}>Citoyen</option>
                                <option value="agent" class="bg-[#020617]" {{ old('role') === 'agent' ? 'selected' : '' }}>Agent</option>
                            </select>
                            <x-input-error :messages="$errors->get('role')" class="mt-1 text-[10px] text-red-400 uppercase font-bold" />
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="group/field">
                            <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-emerald-500/60 mb-2 ml-1">Ville</label>
                            <input type="text" name="city" value="{{ old('city') }}" required
                                   class="block w-full px-5 py-4 bg-white/[0.05] border border-white/5 rounded-2xl focus:border-emerald-500/30 focus:ring-4 focus:ring-emerald-500/10 focus:bg-white/[0.08] transition-all outline-none text-white font-bold"
                                   placeholder="Tanger">
                            <x-input-error :messages="$errors->get('city')" class="mt-1 text-[10px] text-red-400 uppercase font-bold" />
                        </div>

                        <div class="group/field">
                            <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-emerald-500/60 mb-2 ml-1">Adresse</label>
                            <input type="text" name="address" value="{{ old('address') }}" required
                                   class="block w-full px-5 py-4 bg-white/[0.05] border border-white/5 rounded-2xl focus:border-emerald-500/30 focus:ring-4 focus:ring-emerald-500/10 focus:bg-white/[0.08] transition-all outline-none text-white font-bold"
                                   placeholder="Adresse complète">
                            <x-input-error :messages="$errors->get('address')" class="mt-1 text-[10px] text-red-400 uppercase font-bold" />
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="group/field">
                            <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-emerald-500/60 mb-2 ml-1">Sécurité</label>
                            <input type="password" name="password" required 
                                   class="block w-full px-5 py-4 bg-white/[0.05] border border-white/5 rounded-2xl focus:border-emerald-500/30 focus:ring-4 focus:ring-emerald-500/10 focus:bg-white/[0.08] transition-all outline-none text-white font-bold"
                                   placeholder="••••••••">
                        </div>
                        <div class="group/field">
                            <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-emerald-500/60 mb-2 ml-1">Confirmation</label>
                            <input type="password" name="password_confirmation" required 
                                   class="block w-full px-5 py-4 bg-white/[0.05] border border-white/5 rounded-2xl focus:border-emerald-500/30 focus:ring-4 focus:ring-emerald-500/10 focus:bg-white/[0.08] transition-all outline-none text-white font-bold"
                                   placeholder="••••••••">
                        </div>
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-1 text-[10px] text-red-400 uppercase font-bold text-center" />

                    <p class="text-[9px] text-gray-500 text-center uppercase tracking-widest px-4">
                        En cliquant sur créer, vous acceptez nos <a href="#" class="text-emerald-400 hover:underline">conditions d'utilisation</a>.
                    </p>

                    <button class="group relative w-full py-5 bg-gradient-to-r from-emerald-600 to-emerald-400 text-emerald-950 rounded-2xl font-black text-xs uppercase tracking-[0.3em] shadow-[0_20px_40px_-10px_rgba(16,185,129,0.3)] hover:scale-[1.02] active:scale-95 transition-all duration-300 overflow-hidden">
                        <div class="absolute inset-0 bg-white/20 translate-x-[-100%] group-hover:translate-x-[100%] transition-transform duration-700"></div>
                        <span>Créer mon profil</span>
                    </button>
                </form>
            </div>

            <p class="text-center mt-8 text-[11px] font-bold text-gray-500 uppercase tracking-widest">
                Déjà un pionnier ? 
                <a href="{{ route('login') }}" class="text-white hover:text-emerald-400 transition-colors border-b border-white/10 pb-0.5 ml-1">Se connecter</a>
            </p>
        </div>
    </div>
</x-guest-layout>
