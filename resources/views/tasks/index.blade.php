<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tasks for: {{ $project->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-4 flex justify-between items-center">
                <a href="{{ route('projects.index') }}" class="text-gray-600 hover:text-gray-900">&larr; Back to Projects</a>
                
                <form method="GET" action="{{ route('projects.tasks.index', $project) }}" class="flex items-center space-x-2">
                    <label for="status" class="text-sm font-medium text-gray-700">Filter by Status:</label>
                    <select name="status" id="status" class="border-gray-300 rounded-md shadow-sm" onchange="this.form.submit()">
                        <option value="">All Tasks</option>
                        <option value="To Do" {{ request('status') == 'To Do' ? 'selected' : '' }}>To Do</option>
                        <option value="In Progress" {{ request('status') == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                        <option value="Done" {{ request('status') == 'Done' ? 'selected' : '' }}>Done</option>
                    </select>
                </form>

                <a href="{{ route('projects.tasks.create', $project) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Create New Task</a>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                @if(session('success'))
                    <div class="mb-4 text-green-600 font-bold">{{ session('success') }}</div>
                @endif

                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr>
                            <th class="border-b py-2">Title</th>
                            <th class="border-b py-2">Status</th>
                            <th class="border-b py-2">Due Date</th>
                            <th class="border-b py-2 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($tasks as $task)
                            <tr>
                                <td class="border-b py-2">
                                    <div class="font-bold">{{ $task->title }}</div>
                                    <div class="text-sm text-gray-500">{{ $task->description }}</div>
                                </td>
                                <td class="border-b py-2">
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full 
                                        {{ $task->status === 'To Do' ? 'bg-gray-200 text-gray-800' : '' }}
                                        {{ $task->status === 'In Progress' ? 'bg-yellow-200 text-yellow-800' : '' }}
                                        {{ $task->status === 'Done' ? 'bg-green-200 text-green-800' : '' }}">
                                        {{ $task->status }}
                                    </span>
                                </td>
                                <td class="border-b py-2">{{ $task->due_date ? \Carbon\Carbon::parse($task->due_date)->format('M d, Y') : 'No Due Date' }}</td>
                                <td class="border-b py-2 text-right">
                                    <a href="{{ route('projects.tasks.edit', [$project, $task]) }}" class="text-indigo-600 hover:text-indigo-900 mr-2">Edit</a>
                                    <form action="{{ route('projects.tasks.destroy', [$project, $task]) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Delete this task?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-4 text-gray-500">No tasks found. Create one!</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>