<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create New Challenge') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <form method="POST" action="{{ route('challenges.store') }}">
                        @csrf 

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Challenge Title</label>
                            <input type="text" name="title" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required placeholder="e.g. SQL Injection Master">
                        </div>

                        <div class="flex gap-4 mb-4">
                            <div class="w-1/2">
                                <label class="block text-gray-700 text-sm font-bold mb-2">Category</label>
                                <select name="category" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                    <option value="Web">Web Exploitation</option>
                                    <option value="Pwn">Pwnable</option>
                                    <option value="Forensic">Forensic</option>
                                    <option value="Crypto">Cryptography</option>
                                    <option value="Rev">Reverse Engineering</option>
                                </select>
                            </div>
                            <div class="w-1/2">
                                <label class="block text-gray-700 text-sm font-bold mb-2">Difficulty</label>
                                <select name="difficulty" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                    <option value="Noob">Noob</option>
                                    <option value="Easy">Easy</option>
                                    <option value="Medium">Medium</option>
                                    <option value="Hard">Hard</option>
                                    <option value="Insane">Insane</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Price (€)</label>
                            <input type="number" name="price" step="0.01" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required placeholder="0.00">
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Description</label>
                            <textarea name="description" rows="4" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required placeholder="Describe your challenge..."></textarea>
                        </div>

                        <div class="mb-6">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Flag (Answer)</label>
                            <input type="text" name="flag_hash" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required placeholder="PHPWN{this_is_fake_flag}">
                            <p class="text-gray-500 text-xs mt-1">* The flag will be hashed securely.</p>
                        </div>

                        <div class="flex items-center justify-end">
                            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Create Challenge
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>