<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ $challenge->title }}</h2>
                <div class="text-sm text-gray-500">{{ $challenge->category }} · {{ $challenge->difficulty }}</div>
            </div>

            <div class="text-right">
                @if(isset($userSolved) && $userSolved)
                    <span class="inline-flex items-center gap-2 bg-green-100 text-green-800 px-3 py-1 rounded-full font-semibold">
                        ✅ Résolu
                    </span>
                @endif
                <div class="text-lg font-bold text-indigo-600">{{ number_format($challenge->price, 2) }} €</div>
                @auth
                    @if(Auth::id() === $challenge->author_id)
                        <div class="mt-2">
                            <a href="{{ route('challenges.edit', $challenge->id) }}" class="inline-block text-sm bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded">Modifier</a>
                        </div>
                    @endif
                @endauth
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 md:flex md:gap-6">
                    <div class="md:w-2/3">
                        @if(session('success'))
                            <div class="bg-green-100 text-green-700 p-3 rounded mb-4 border border-green-200">
                                {{ session('success') }}
                            </div>
                        @endif
                        @if(session('error'))
                            <div class="bg-red-100 text-red-700 p-3 rounded mb-4 border border-red-200">
                                {{ session('error') }}
                            </div>
                        @endif
                        @if(session('info'))
                            <div class="bg-yellow-100 text-yellow-700 p-3 rounded mb-4 border border-yellow-200">
                                {{ session('info') }}
                            </div>
                        @endif

                        <h3 class="text-lg font-semibold mb-2">Description</h3>
                        <p class="text-gray-700 mb-4">{{ $challenge->description }}</p>

                        <h3 class="text-lg font-semibold mb-2">Soumettre un flag</h3>
                        @auth
                            @if(isset($userSolved) && $userSolved)
                                <div class="bg-green-50 border border-green-100 text-green-800 px-4 py-3 rounded mb-4">Vous avez déjà résolu ce challenge.</div>
                            @else
                                <form action="{{ route('challenges.submitFlag', $challenge->id) }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <input type="text" name="flag" placeholder="flag{...}" class="w-full border border-gray-300 rounded px-3 py-2 text-sm" />
                                    </div>
                                    <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Soumettre</button>
                                </form>
                            @endif
                        @else
                            <div class="text-sm text-gray-500">Connectez-vous pour soumettre un flag.</div>
                        @endauth
                    </div>

                    <aside class="md:w-1/3 mt-6 md:mt-0">
                        <div class="p-4 border-l border-gray-100">
                            <h4 class="font-semibold mb-2">Ressources</h4>
                            @auth
                                @if($purchased)
                                    <a href="{{ route('challenges.download', $challenge->id) }}" class="block mb-2 bg-indigo-600 text-white text-center py-2 rounded hover:bg-indigo-700">Télécharger les fichiers</a>
                                @else
                                    <div class="text-sm text-gray-500 mb-2">Achat requis pour télécharger les ressources.</div>
                                @endif
                            @else
                                <a href="{{ route('login') }}" class="block mb-2 bg-gray-900 text-white text-center py-2 rounded">Se connecter</a>
                            @endauth

                            <div class="mt-4">
                                <div class="text-sm text-gray-500">Auteur</div>
                                <div class="font-semibold">{{ $challenge->author->username ?? 'Unknown' }}</div>
                            </div>
                        </div>
                    </aside>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
