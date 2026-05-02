<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center relative px-6 overflow-hidden bg-[#020617]">

        <div class="absolute inset-0 -z-10">
            <div class="absolute top-[-20%] left-[-10%] w-[600px] h-[600px] bg-emerald-500/10 rounded-full blur-[120px]"></div>
            <div class="absolute bottom-[-20%] right-[-10%] w-[500px] h-[500px] bg-teal-900/20 rounded-full blur-[120px]"></div>
            <div class="absolute inset-0 bg-[url('https://grainy-gradients.vercel.app/noise.svg')] opacity-20"></div>
        </div>

        <div class="w-full max-w-[440px] relative">

            <div class="text-center mb-10   ">
                <a href="/">
                    <img src="{{ asset('images/logo.png') }}" class="h-16 w-auto mx-auto brightness-125 drop-shadow-[0_0_15px_rgba(16,185,129,0.3)] scale-[1.7]" alt="Logo GreenLink">
                </a>
                <h2 class="mt-6 text-3xl font-black text-white tracking-tighter uppercase">Connectez<span class="text-emerald-400 font-normal italic lowercase">-vous</span></h2>
                <p class="text-gray-500 text-sm font-medium mt-2">Accédez à votre espace GreenLink</p>
            </div>

            <div class="bg-white/[0.03] backdrop-blur-2xl p-10 rounded-[2.5rem] border border-white/10 shadow-2xl relative overflow-hidden group">
                <div class="absolute -top-24 -right-24 w-48 h-48 bg-emerald-500/10 rounded-full blur-3xl group-hover:bg-emerald-500/20 transition-all duration-700"></div>

                <form method="POST" action="{{ route('login') }}" class="space-y-6 relative z-10">
                    @csrf
                    <input type="hidden" name="latitude" id="latitude">
                    <input type="hidden" name="longitude" id="longitude">

                    <div class="group/field">
                        <label class="block text-[10px] font-black uppercase tracking-[0.3em] text-emerald-500/60 mb-2 ml-1 group-focus-within/field:text-emerald-400 transition-colors">Identifiant e-mail</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-gray-500 group-focus-within/field:text-emerald-400 transition-colors">
                                <i class="fas fa-at"></i>
                            </span>
                            <input type="email" name="email" :value="old('email')" required autofocus
                                class="block w-full pl-11 pr-5 py-4 bg-white/[0.05] border border-white/5 rounded-2xl focus:border-emerald-500/30 focus:ring-4 focus:ring-emerald-500/10 focus:bg-white/[0.08] transition-all duration-300 outline-none text-white font-bold placeholder:text-gray-600"
                                placeholder="votre@email.com">
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-2 text-xs text-red-400" />
                    </div>

                    <div class="group/field">
                        <div class="flex justify-between items-center mb-2 ml-1">
                            <label class="block text-[10px] font-black uppercase tracking-[0.3em] text-emerald-500/60 group-focus-within/field:text-emerald-400 transition-colors">Mot de passe</label>
                            @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-[9px] font-black text-gray-500 uppercase tracking-widest hover:text-emerald-400 transition-colors">Perdu ?</a>
                            @endif
                        </div>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-gray-500 group-focus-within/field:text-emerald-400 transition-colors">
                                <i class="fas fa-lock text-sm"></i>
                            </span>
                            <input type="password" name="password" required
                                class="block w-full pl-11 pr-5 py-4 bg-white/[0.05] border border-white/5 rounded-2xl focus:border-emerald-500/30 focus:ring-4 focus:ring-emerald-500/10 focus:bg-white/[0.08] transition-all duration-300 outline-none text-white font-bold placeholder:text-gray-600"
                                placeholder="••••••••">
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2 text-xs text-red-400" />
                    </div>

                    <div class="flex items-center ml-1">
                        <input id="remember_me" type="checkbox" name="remember" class="rounded border-white/10 bg-white/5 text-emerald-500 focus:ring-emerald-500/20 focus:ring-offset-0">
                        <span class="ml-2 text-[11px] font-bold text-gray-500 tracking-tight">Maintenir la session</span>
                    </div>

                    <button class="group relative w-full py-5 bg-emerald-500 text-emerald-950 rounded-2xl font-black text-xs uppercase tracking-[0.2em] shadow-[0_15px_30px_-5px_rgba(16,185,129,0.3)] hover:scale-[1.02] active:scale-95 transition-all duration-300 overflow-hidden">
                        <div class="absolute inset-0 bg-white/30 translate-x-[-100%] group-hover:translate-x-[100%] transition-transform duration-700"></div>
                        <span class="relative">Entrer dans le système</span>
                    </button>
                </form>
            </div>

            <p class="text-center mt-10 text-[11px] font-bold text-gray-500 uppercase tracking-widest">
                Nouvel utilisateur ?
                <a href="{{ route('register') }}" class="text-white hover:text-emerald-400 transition-colors border-b border-white/10 pb-0.5 ml-1">Créer un compte</a>
            </p>
        </div>
    </div>

    <style>
        @keyframes float {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        .animate-float {
            animation: float 5s ease-in-out infinite;
        }
    </style>
    <script>
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function (position) {
                document.getElementById('latitude').value = position.coords.latitude;
                document.getElementById('longitude').value = position.coords.longitude;
            });
        }
    </script>
</x-guest-layout>
