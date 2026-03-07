<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Task List') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-4 flex justify-between items-center">
                <a href="{{ route('projects.index') }}" class="text-white hover:text-blue-300 font-medium">&larr; Back to Projects</a>
                
                <form method="GET" action="{{ route('projects.tasks.index', $project) }}" class="flex items-center space-x-2">
                    <label for="status" class="text-sm font-medium text-white">Filter by Status:</label>
                    <select name="status" id="status" class="bg-gray-800 text-white border-gray-700 rounded-md shadow-sm" onchange="this.form.submit()">
                        <option value="">All Tasks</option>
                        <option value="To Do" {{ request('status') == 'To Do' ? 'selected' : '' }}>To Do</option>
                        <option value="In Progress" {{ request('status') == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                        <option value="Done" {{ request('status') == 'Done' ? 'selected' : '' }}>Done</option>
                    </select>
                </form>

                <a href="{{ route('projects.tasks.create', $project) }}" class="bg-[#1f2937] hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Create New Task</a>
            </div>

            <div class="bg-[#1f2937] overflow-hidden sm:rounded-lg p-6 shadow-lg text-white">
                @if(session('success'))
                    <div class="mb-4 text-green-400 font-bold">{{ session('success') }}</div>
                @endif

                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr>
                            <th class="border-b border-gray-600 py-2">Title</th>
                            <th class="border-b border-gray-600 py-2 w-32 whitespace-nowrap text-center">Status</th>
                            <th class="border-b border-gray-600 py-2 w-32 whitespace-nowrap text-center">Due Date</th>
                            <th class="border-b border-gray-600 py-2 w-24 whitespace-nowrap text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($tasks as $task)
                            <tr class="hover:bg-gray-700 transition duration-150">
                                <td class="border-b border-gray-600 py-3">
                                    <div class="font-bold">{{ $task->title }}</div>
                                    <div class="text-sm text-gray-400">{{ $task->description }}</div>
                                </td>
                                
                                <td class="border-b border-gray-600 py-3 w-32 whitespace-nowrap text-center">
                                    <span class="px-3 py-1 text-xs font-semibold rounded-full border 
                                        {{ $task->status === 'To Do' ? 'border-red-400 text-red-200 bg-red-900/50' : '' }}
                                        {{ $task->status === 'In Progress' ? 'border-yellow-400 text-yellow-200 bg-yellow-900/50' : '' }}
                                        {{ $task->status === 'Done' ? 'border-green-400 text-green-200 bg-green-900/50' : '' }}">
                                        {{ $task->status }}
                                    </span>
                                </td>
                                
                                <td class="border-b border-gray-600 py-3 w-32 whitespace-nowrap text-center text-gray-300">
                                    {{ $task->due_date ? \Carbon\Carbon::parse($task->due_date)->format('M d, Y') : 'No Due Date' }}
                                </td>
                                
                                <td class="border-b border-gray-600 py-3 w-24 whitespace-nowrap text-center">
                                    <div class="flex justify-center items-center space-x-4">
                                        <a href="{{ route('projects.tasks.edit', [$project, $task]) }}" class="text-indigo-400 hover:text-indigo-300 transition" title="Edit Task">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                        </a>
                                        <form action="{{ route('projects.tasks.destroy', [$project, $task]) }}" method="POST" class="inline m-0 p-0">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-400 hover:text-red-300 focus:outline-none transition" title="Delete Task" onclick="return confirm('Delete this task?')">
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-6 text-gray-400">No tasks found. Create one!</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>