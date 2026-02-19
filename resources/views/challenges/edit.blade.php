<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">✏️ Edit Challenge</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <form method="POST" action="{{ route('challenges.update', $challenge->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    <div class="mb-4">
                        <label for="title" class="block text-gray-700 font-bold mb-2">Challenge Title</label>
                        <input type="text" name="title" id="title" value="{{ old('title', $challenge->title) }}" class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200" required>
                    </div>

                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label for="category" class="block text-gray-700 font-bold mb-2">Category</label>
                            <select name="category" id="category" class="w-full border-gray-300 rounded-md shadow-sm">
                                <option value="Web" {{ old('category', $challenge->category) == 'Web' ? 'selected' : '' }}>Web</option>
                                <option value="Pwn" {{ old('category', $challenge->category) == 'Pwn' ? 'selected' : '' }}>Pwn</option>
                                <option value="Reversing" {{ old('category', $challenge->category) == 'Reversing' ? 'selected' : '' }}>Reversing</option>
                                <option value="Crypto" {{ old('category', $challenge->category) == 'Crypto' ? 'selected' : '' }}>Crypto</option>
                                <option value="Forensic" {{ old('category', $challenge->category) == 'Forensic' ? 'selected' : '' }}>Forensic</option>
                            </select>
                        </div>

                        <div>
                            <label for="difficulty" class="block text-gray-700 font-bold mb-2">Difficulty</label>
                            <select name="difficulty" id="difficulty" class="w-full border-gray-300 rounded-md shadow-sm">
                                <option value="Easy" {{ old('difficulty', $challenge->difficulty) == 'Easy' ? 'selected' : '' }}>Easy</option>
                                <option value="Medium" {{ old('difficulty', $challenge->difficulty) == 'Medium' ? 'selected' : '' }}>Medium</option>
                                <option value="Hard" {{ old('difficulty', $challenge->difficulty) == 'Hard' ? 'selected' : '' }}>Hard</option>
                                <option value="Insane" {{ old('difficulty', $challenge->difficulty) == 'Insane' ? 'selected' : '' }}>Insane</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="price" class="block text-gray-700 font-bold mb-2">Price (€)</label>
                        <input type="number" step="0.01" name="price" id="price" value="{{ old('price', $challenge->price) }}" class="w-full border-gray-300 rounded-md shadow-sm" placeholder="10.00" required>
                    </div>

                    <div class="mb-4">
                        <label for="challenge_file" class="block text-gray-700 font-bold mb-2">Replace Challenge File (Optional)</label>
                        <input type="file" name="challenge_file" id="challenge_file" class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200">
                        <p class="text-xs text-gray-500 mt-1">* Upload to replace existing resource. Allowed: .zip, .tar, .gz, .txt, .pdf, .exe, .bin (Max: 20MB)</p>
                        @if($challenge->file_path)
                            <p class="text-xs text-gray-500 mt-2">Current file: {{ basename($challenge->file_path) }}</p>
                        @endif
                    </div>
                    <div class="mb-6">
                        <label for="description" class="block text-gray-700 font-bold mb-2">Description</label>
                        <textarea name="description" id="description" rows="4" class="w-full border-gray-300 rounded-md shadow-sm" required>{{ old('description', $challenge->description) }}</textarea>
                    </div>

                    <div class="flex justify-between items-center">
                        <div>
                            <label class="inline-flex items-center">
                                <input type="checkbox" name="is_active" class="form-checkbox" {{ $challenge->is_active ? 'checked' : '' }}>
                                <span class="ml-2 text-sm text-gray-700">Active</span>
                            </label>
                        </div>

                        <div class="flex gap-2">
                            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">Save</button>
                        </div>
                    </div>
                </form>

                <!-- Delete Form (separate from Update form) -->
                <form method="POST" action="{{ route('challenges.destroy', $challenge->id) }}" onsubmit="return confirm('Are you sure you want to delete this challenge? This action cannot be undone.');" class="mt-6 pt-6 border-t">
                    @csrf
                    @method('DELETE')
                    <div class="flex items-center gap-2">
                        <span class="text-sm text-gray-700">Danger zone:</span>
                        <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Delete Challenge</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>