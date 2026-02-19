<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            🧾 Mes achats
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                @if($invoices->count() === 0)
                    <div class="text-center py-12">
                        <p class="text-gray-500 text-lg">Vous n'avez aucun achat pour le moment.</p>
                        <a href="{{ route('home') }}" class="mt-4 inline-block text-indigo-600 font-bold hover:underline">Explorer les challenges &rarr;</a>
                    </div>
                @else
                    @foreach($invoices as $invoice)
                        <div class="mb-6 border border-gray-200 rounded">
                            <div class="px-6 py-4 bg-gray-50 flex justify-between items-center">
                                <div>
                                    <div class="text-sm text-gray-600">Date: {{ $invoice->created_at->format('d/m/Y H:i') }}</div>
                                    <div class="text-lg font-bold text-gray-800">Total: {{ number_format($invoice->total_amount, 2) }} €</div>
                                </div>
                                <div class="text-right">
                                    <span class="px-3 py-1 rounded-full text-sm font-semibold {{ $invoice->status === 'paid' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">{{ ucfirst($invoice->status) }}</span>
                                </div>
                            </div>

                            <div class="p-6">
                                <table class="min-w-full leading-normal">
                                    <thead>
                                        <tr class="border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                            <th class="px-5 py-3">Challenge</th>
                                            <th class="px-5 py-3">Category</th>
                                            <th class="px-5 py-3 text-right">Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($invoice->items as $item)
                                            <tr class="border-b border-gray-200 hover:bg-gray-50">
                                                <td class="px-5 py-5 text-sm">
                                                    <p class="text-gray-900 font-bold">{{ $item->challenge->title ?? 'Challenge supprimé' }}</p>
                                                </td>
                                                <td class="px-5 py-5 text-sm">
                                                    <span class="bg-indigo-100 text-indigo-800 text-xs font-semibold px-2.5 py-0.5 rounded">
                                                        {{ $item->challenge->category ?? '-' }}
                                                    </span>
                                                </td>
                                                <td class="px-5 py-5 text-sm text-right">{{ number_format($item->price, 2) }} €</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endforeach

                    <div class="mt-6">
                        {{ $invoices->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
