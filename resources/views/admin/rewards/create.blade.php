<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.rewards.index') }}" class="text-gray-500 hover:text-white transition-colors">
                <i class="fas fa-arrow-left"></i>
            </a>
            <h2 class="font-black text-2xl text-white uppercase tracking-tighter italic">Créer une récompense</h2>
        </div>
    </x-slot>

    <div class="py-12 px-4">
        <div class="max-w-3xl mx-auto">
            <form action="{{ route('admin.rewards.store') }}" method="POST" class="bg-white/[0.02] backdrop-blur-xl border border-white/10 rounded-[3rem] p-10 space-y-8 relative overflow-hidden">
                <div class="absolute inset-0 bg-grainy opacity-5 pointer-events-none"></div>
                @csrf

                @include('admin.rewards.partials.form', [
                    'voucher' => null,
                    'submitLabel' => 'Enregistrer la récompense',
                ])
            </form>
        </div>
    </div>
</x-app-layout>
