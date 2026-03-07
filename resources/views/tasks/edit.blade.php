<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Task') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-[#1f2937] overflow-hidden sm:rounded-lg p-6 shadow-lg text-white">
                <form action="{{ route('projects.tasks.update', [$project, $task]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-4">
                        <label for="title" class="block text-gray-300 font-bold mb-2">Task Title</label>
                        <input type="text" name="title" id="title" class="bg-gray-800 border-gray-600 text-white rounded-md shadow-sm w-full focus:ring focus:ring-blue-500 focus:border-blue-500" value="{{ old('title', $task->title) }}" required>
                        @error('title') <span class="text-red-400 text-sm mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-4">
                        <label for="description" class="block text-gray-300 font-bold mb-2">Description</label>
                        <textarea name="description" id="description" class="bg-gray-800 border-gray-600 text-white rounded-md shadow-sm w-full focus:ring focus:ring-blue-500 focus:border-blue-500" rows="3">{{ old('description', $task->description) }}</textarea>
                        @error('description') <span class="text-red-400 text-sm mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-4">
                        <label for="status" class="block text-gray-300 font-bold mb-2">Status</label>
                        <select name="status" id="status" class="bg-gray-800 border-gray-600 text-white rounded-md shadow-sm w-full focus:ring focus:ring-blue-500 focus:border-blue-500" required>
                            <option value="To Do" {{ old('status', $task->status) == 'To Do' ? 'selected' : '' }}>To Do</option>
                            <option value="In Progress" {{ old('status', $task->status) == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                            <option value="Done" {{ old('status', $task->status) == 'Done' ? 'selected' : '' }}>Done</option>
                        </select>
                        @error('status') <span class="text-red-400 text-sm mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-6">
                        <label for="due_date" class="block text-gray-300 font-bold mb-2">Due Date</label>
                        <input type="date" name="due_date" id="due_date" class="bg-gray-800 border-gray-600 text-white rounded-md shadow-sm w-full focus:ring focus:ring-blue-500 focus:border-blue-500" value="{{ old('due_date', $task->due_date) }}">
                        @error('due_date') <span class="text-red-400 text-sm mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition">Update Task</button>
                    <a href="{{ route('projects.tasks.index', $project) }}" class="ml-4 text-gray-400 hover:text-white transition">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>