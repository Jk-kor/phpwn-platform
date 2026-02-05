<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                🔥 CTF Challenges Marketplace
            </h2>
            <a href="{{ route('challenges.create') }}" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded shadow transition duration-300">
                + Sell a Challenge
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                
                @forelse($challenges as $challenge)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg hover:shadow-xl transition-shadow duration-300">
                        <div class="h-48 bg-gray-200 flex items-center justify-center">
                            <span class="text-4xl">🏴‍☠️</span>
                        </div>
                        
                        <div class="p-6">
                            <div class="flex justify-between items-center mb-2">
                                <span class="bg-indigo-100 text-indigo-800 text-xs font-semibold px-2.5 py-0.5 rounded">
                                    {{ $challenge->category }}
                                </span>
                                <span class="text-sm text-gray-500">{{ $challenge->difficulty }}</span>
                            </div>

                            <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $challenge->title }}</h3>
                            
                            <p class="text-2xl font-bold text-indigo-600 mb-4">{{ number_format($challenge->price, 2) }} €</p>
                            
                            <p class="text-gray-600 text-sm mb-4 line-clamp-2">
                                {{ $challenge->description }}
                            </p>

                            <form action="{{ route('cart.add', $challenge->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="w-full bg-gray-900 hover:bg-gray-800 text-white font-bold py-2 px-4 rounded transition duration-300 flex justify-center items-center gap-2">
                                    <span>🛒</span> Add to Cart
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="col-span-3 text-center py-12 bg-white rounded-lg shadow">
                        <p class="text-gray-500 text-lg">No challenges available yet.</p>
                        <p class="text-gray-400">Be the first to sell one!</p>
                    </div>
                @endforelse

            </div>
        </div>
    </div>
    @if(session('show_cart_modal'))
    <div class="fixed inset-0 z-50 flex items-center justify-center bg-gray-900 bg-opacity-50 px-4" style="backdrop-filter: blur(2px);">
        
        <div class="bg-white rounded-2xl shadow-2xl p-5 text-center transform transition-all relative" style="width: 350px; max-width: 90%;">

            <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-green-100 mb-4">
                <svg class="h-6 w-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>

            <h3 class="text-lg font-bold text-gray-900">Added!</h3>
            <p class="text-sm text-gray-500 mt-1 mb-6">
                장바구니에 담겼습니다.
            </p>

            <div class="flex flex-col space-y-2">
                <a href="{{ route('cart.index') }}" class="w-full py-3 px-4 rounded-xl font-bold text-white bg-indigo-600 hover:bg-indigo-700 shadow-md transition-colors text-sm">
                    💳 Checkout Now
                </a>

                <a href="{{ route('home') }}" class="w-full py-3 px-4 rounded-xl font-bold text-gray-700 bg-gray-100 hover:bg-gray-200 transition-colors text-sm">
                    🛍️ Keep Shopping
                </a>
            </div>

        </div>
    </div>
    @endif
</x-app-layout>