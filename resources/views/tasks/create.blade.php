<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Create Task for {{ $project->name }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('projects.tasks.store', $project) }}" method="POST">
                    @csrf
                    
                    <div class="mb-4">
                        <label for="title" class="block text-gray-700 font-bold mb-2">Task Title</label>
                        <input type="text" name="title" id="title" class="border-gray-300 rounded-md shadow-sm w-full" value="{{ old('title') }}" required>
                        @error('title') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-4">
                        <label for="description" class="block text-gray-700 font-bold mb-2">Description (Optional)</label>
                        <textarea name="description" id="description" class="border-gray-300 rounded-md shadow-sm w-full" rows="3">{{ old('description') }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label for="status" class="block text-gray-700 font-bold mb-2">Status</label>
                        <select name="status" id="status" class="border-gray-300 rounded-md shadow-sm w-full" required>
                            <option value="To Do" {{ old('status') == 'To Do' ? 'selected' : '' }}>To Do</option>
                            <option value="In Progress" {{ old('status') == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                            <option value="Done" {{ old('status') == 'Done' ? 'selected' : '' }}>Done</option>
                        </select>
                        @error('status') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-4">
                        <label for="due_date" class="block text-gray-700 font-bold mb-2">Due Date (Optional)</label>
                        <input type="date" name="due_date" id="due_date" class="border-gray-300 rounded-md shadow-sm w-full" value="{{ old('due_date') }}">
                    </div>

                    <button type="submit" class="ml-4 text-gray-600 hover:text-gray-900">Save Task</button>
                    <a href="{{ route('projects.tasks.index', $project) }}" class="ml-4 text-gray-600 hover:text-gray-900">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>