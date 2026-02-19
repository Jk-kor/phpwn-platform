<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            🛒 Your Shopping Cart
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
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

                @if($cartItems->count() > 0)
                    <table class="min-w-full leading-normal">
                        <thead>
                            <tr class="border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                <th class="px-5 py-3">Challenge Title</th>
                                <th class="px-5 py-3">Category</th>
                                <th class="px-5 py-3 text-right">Price</th>
                                <th class="px-5 py-3"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cartItems as $item)
                                <tr class="border-b border-gray-200 hover:bg-gray-50">
                                    <td class="px-5 py-5 text-sm">
                                        <p class="text-gray-900 font-bold">{{ $item->challenge->title }}</p>
                                    </td>
                                    <td class="px-5 py-5 text-sm">
                                        <span class="bg-indigo-100 text-indigo-800 text-xs font-semibold px-2.5 py-0.5 rounded">
                                            {{ $item->challenge->category }}
                                        </span>
                                    </td>
                                    <td class="px-5 py-5 text-sm text-right">
                                        {{ number_format($item->challenge->price, 2) }} €
                                    </td>
                                    <td class="px-5 py-5 text-sm text-right">
                                        <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900 font-bold text-xs uppercase">
                                                Remove
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            
                            <tr class="bg-gray-50">
                                <td colspan="2" class="px-5 py-5 text-right font-bold text-gray-700 uppercase">Total Amount:</td>
                                <td class="px-5 py-5 text-right font-bold text-xl text-indigo-600">{{ number_format($total, 2) }} €</td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="mt-8 flex justify-end">
                        <form action="{{ route('checkout.process') }}" method="POST">
                            @csrf
                            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-6 rounded shadow-lg transform hover:scale-105 transition duration-300">
                                💳 Proceed to Checkout
                            </button>
                        </form>
                    </div>
                    @else
                    <div class="text-center py-12">
                        <div class="text-6xl mb-4">🛒</div>
                        <p class="text-gray-500 text-lg">Your cart is empty.</p>
                        <a href="{{ route('home') }}" class="mt-4 inline-block text-indigo-600 font-bold hover:underline">
                            Browse Challenges &rarr;
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>