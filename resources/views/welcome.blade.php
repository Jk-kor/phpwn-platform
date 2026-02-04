<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Plateforme PHPWN</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800 antialiased font-sans">

    <nav class="bg-white shadow fixed w-full z-10 top-0">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="/" class="text-2xl font-bold text-indigo-600">🚩 PHPWN</a>
                </div>
                <div class="flex items-center">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="text-gray-700 hover:text-indigo-600 px-3 py-2 rounded-md text-sm font-medium">Tableau de bord</a>
                            <a href="{{ route('challenges.create') }}" class="ml-4 bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-md text-sm font-bold">+ Vendre un challenge</a>
                        @else
                            <a href="{{ route('login') }}" class="text-gray-700 hover:text-indigo-600 px-3 py-2 rounded-md text-sm font-medium">Connexion</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="ml-4 bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md text-sm font-medium">Inscription</a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto py-24 px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h1 class="text-4xl font-extrabold text-gray-900 sm:text-5xl sm:tracking-tight lg:text-6xl">
                Marché Capture The Flag
            </h1>
            <p class="mt-5 max-w-xl mx-auto text-xl text-gray-500">
                Achetez, vendez et échangez des challenges CTF.
            </p>
        </div>

    <h2 class="text-2xl font-bold mb-6 border-b pb-2">🛒 Challenges récents</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($challenges as $challenge)
                <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-2">
                            <span class="bg-indigo-100 text-indigo-800 text-xs font-semibold px-2.5 py-0.5 rounded">{{ $challenge->category }}</span>
                            <span class="bg-yellow-100 text-yellow-800 text-xs font-semibold px-2.5 py-0.5 rounded">{{ $challenge->difficulty }}</span>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $challenge->title }}</h3>
                        <p class="text-gray-600 text-sm mb-4 h-12 overflow-hidden">{{ Str::limit($challenge->description, 80) }}</p>
                        
                        <div class="flex items-center justify-between mt-4 pt-4 border-t border-gray-100">
                            <div class="flex items-center">
                                <div class="text-sm">
                                    <p class="text-gray-900 leading-none">Par {{ $challenge->author->username ?? 'Inconnu' }}</p>
                                    <p class="text-gray-500 text-xs">{{ $challenge->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                            <div class="text-lg font-bold text-green-600">
                                {{ number_format($challenge->price, 2) }} €
                            </div>
                        </div>
                        <button class="mt-4 w-full bg-gray-800 text-white font-bold py-2 px-4 rounded hover:bg-gray-700">
                            Voir les détails
                        </button>
                    </div>
                </div>
            @empty
                <div class="col-span-3 text-center py-12">
                    <p class="text-gray-500 text-lg">Aucun challenge enregistré. Soyez le premier à en proposer un !</p>
                </div>
            @endforelse
        </div>
    </div>
</body>
</html>