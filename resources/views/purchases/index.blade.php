<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">🧾 Mes achats</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                @if($challenges->isEmpty())
                    <div class="text-center py-12">
                        <p class="text-gray-500 text-lg">Vous n'avez acheté aucun challenge pour le moment.</p>
                        <a href="{{ route('home') }}" class="mt-4 inline-block text-indigo-600 font-bold hover:underline">Explorer les challenges &rarr;</a>
                    </div>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @foreach($challenges as $challenge)
                            <div class="bg-white shadow rounded-lg p-4 border border-gray-100">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <a href="{{ route('challenges.show', $challenge->id) }}" class="text-lg font-bold text-gray-900 hover:underline">{{ $challenge->title }}</a>
                                        <div class="text-sm text-gray-500">{{ $challenge->category }} · {{ $challenge->difficulty }}</div>
                                    </div>
                                    <div class="text-indigo-600 font-bold">{{ number_format($challenge->price, 2) }} €</div>
                                </div>
                                <p class="text-sm text-gray-600 mt-3 line-clamp-2">{{ $challenge->description }}</p>
                                <div class="mt-4 flex gap-2">
                                    <a href="{{ route('challenges.show', $challenge->id) }}" class="text-sm px-3 py-2 bg-gray-100 rounded hover:bg-gray-200">Voir</a>
                                    <a href="{{ route('challenges.download', $challenge->id) }}" class="text-sm px-3 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">Télécharger</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
