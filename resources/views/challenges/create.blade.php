<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            🚩 Sell a New Challenge
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <form method="POST" action="{{ route('challenges.store') }}">
                    @csrf

                    <div class="mb-4">
                        <label for="title" class="block text-gray-700 font-bold mb-2">Challenge Title</label>
                        <input type="text" name="title" id="title" class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200" required>
                    </div>

                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label for="category" class="block text-gray-700 font-bold mb-2">Category</label>
                            <select name="category" id="category" class="w-full border-gray-300 rounded-md shadow-sm">
                                <option value="Web">Web</option>
                                <option value="Pwn">Pwn</option>
                                <option value="Reversing">Reversing</option>
                                <option value="Crypto">Crypto</option>
                                <option value="Forensic">Forensic</option>
                            </select>
                        </div>

                        <div>
                            <label for="difficulty" class="block text-gray-700 font-bold mb-2">Difficulty</label>
                            <select name="difficulty" id="difficulty" class="w-full border-gray-300 rounded-md shadow-sm">
                                <option value="Easy">Easy</option>
                                <option value="Medium">Medium</option>
                                <option value="Hard">Hard</option>
                                <option value="Insane">Insane</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="price" class="block text-gray-700 font-bold mb-2">Price (€)</label>
                        <input type="number" step="0.01" name="price" id="price" class="w-full border-gray-300 rounded-md shadow-sm" placeholder="10.00" required>
                    </div>

                    <div class="mb-4">
                        <label for="flag_hash" class="block text-gray-700 font-bold mb-2">Flag (Answer)</label>
                        <input type="text" name="flag_hash" id="flag_hash" class="w-full border-gray-300 rounded-md shadow-sm" placeholder="CTF{...}" required>
                        <p class="text-xs text-gray-500 mt-1">* The flag will be securely hashed.</p>
                    </div>

                    <div class="mb-6">
                        <label for="description" class="block text-gray-700 font-bold mb-2">Description</label>
                        <textarea name="description" id="description" rows="4" class="w-full border-gray-300 rounded-md shadow-sm" required></textarea>
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded shadow-lg transition duration-300">
                            🚀 Publish Challenge
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>