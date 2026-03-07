<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Create Project</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('projects.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="name" class="block text-gray-700 font-bold mb-2">Project Name</label>
                        <input type="text" name="name" id="name" class="border-gray-300 rounded-md shadow-sm w-full" value="{{ old('name') }}" required>
                        @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Save Project</button>
                    <a href="{{ route('projects.index') }}" class="ml-4 text-gray-600 hover:text-gray-900">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>