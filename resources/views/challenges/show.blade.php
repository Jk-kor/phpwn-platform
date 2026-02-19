<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ $challenge->title }}</h2>
            <div class="text-right">
                <div class="text-sm text-gray-500">{{ $challenge->category }} · {{ $challenge->difficulty }}</div>
                <div class="text-lg font-bold text-indigo-600">{{ number_format($challenge->price, 2) }} €</div>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
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

                <div class="mb-6">
                    <p class="text-gray-700">{{ $challenge->description }}</p>
                </div>

                <div class="flex items-center gap-4">
                    @auth
                        @if($purchased)
                            <a href="{{ route('challenges.download', $challenge->id) }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded shadow">
                                ⬇️ Download Resources
                            </a>
                        @else
                            <button disabled class="bg-gray-300 text-gray-700 font-bold py-2 px-4 rounded cursor-not-allowed">Purchase required</button>
                        @endif
                    @else
                        <a href="{{ route('login') }}" class="bg-gray-900 hover:bg-gray-800 text-white font-bold py-2 px-4 rounded">Log in to access</a>
                    @endauth

                    @auth
                        <form action="{{ route('challenges.submitFlag', $challenge->id) }}" method="POST" class="w-full max-w-sm">
                            @csrf
                            <div class="flex items-center gap-2">
                                <input type="text" name="flag" placeholder="flag{...}" class="w-full border border-gray-300 rounded px-3 py-2 text-sm" />
                                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-3 rounded">Submit</button>
                            </div>
                        </form>
                    @else
                        <div class="text-sm text-gray-500">Connectez-vous pour soumettre un flag.</div>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
