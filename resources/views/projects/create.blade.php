<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Create Project</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-[#1f2937] overflow-hidden sm:rounded-lg p-6 shadow-lg text-white">
                <form action="{{ route('projects.store') }}" method="POST">
                    @csrf
                    <div class="mb-6">
                        <label for="name" class="block text-gray-300 font-bold mb-2">Project Name</label>
                        <input type="text" name="name" id="name" class="bg-gray-800 border-gray-600 text-white rounded-md shadow-sm w-full focus:ring focus:ring-blue-500 focus:border-blue-500" value="{{ old('name') }}" required>
                        @error('name') <span class="text-red-400 text-sm mt-1 block">{{ $message }}</span> @enderror
                    </div>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition">Save Project</button>
                    <a href="{{ route('projects.index') }}" class="ml-4 text-gray-400 hover:text-white transition">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>