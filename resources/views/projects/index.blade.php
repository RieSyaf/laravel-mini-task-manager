<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Project List') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-4 flex justify-end">
                <a href="{{ route('projects.create') }}" class="bg-[#1f2937] hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Create New Project</a>
            </div>
            
            <div class="bg-[#1f2937] overflow-hidden sm:rounded-lg p-6 shadow-lg text-white">
                @if(session('success'))
                    <div class="mb-4 text-green-400 font-bold">{{ session('success') }}</div>
                @endif

                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr>
                            <th class="border-b border-gray-600 py-2">Project Name</th>
                            <th class="border-b border-gray-600 py-2 w-1/3 text-center">Progress</th>
                            <th class="border-b border-gray-600 py-2 w-32 whitespace-nowrap text-center">Created At</th>
                            <th class="border-b border-gray-600 py-2 w-32 whitespace-nowrap text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($projects as $project)
                            @php
                                $total = $project->tasks->count();
                                $doneCount = $project->tasks->where('status', 'Done')->count();
                                $inProgressCount = $project->tasks->where('status', 'In Progress')->count();
                                $toDoCount = $project->tasks->where('status', 'To Do')->count();
                                $done = $total > 0 ? ($doneCount / $total) * 100 : 0;
                                $inProgress = $total > 0 ? ($inProgressCount / $total) * 100 : 0;
                                $toDo = $total > 0 ? ($toDoCount / $total) * 100 : 0;
                            @endphp
                            
                            <tr class="hover:bg-gray-700 transition duration-150">
                                <td class="border-b border-gray-600 py-30 font-medium">{{ $project->name }}</td>
                                
                                <td class="border-b border-gray-600 py-30 px-4">
                                    @if($total > 0)
                                        <div class="w-full max-w-sm mx-auto flex flex-col items-center">
                                            <div class="w-full bg-gray-700 rounded-full h-2 flex overflow-hidden shadow-inner">
                                                <div class="bg-green-500 h-2" style="width: {{ $done }}%" title="Done = {{ $doneCount }} ({{ number_format($done, 1) }}%)"></div>
                                                <div class="bg-yellow-400 h-2" style="width: {{ $inProgress }}%" title="In Progress = {{ $inProgressCount }} ({{ number_format($inProgress, 1) }}%)"></div>
                                                <div class="bg-red-500 h-2" style="width: {{ $toDo }}%" title="To Do = {{ $toDoCount }} ({{ number_format($toDo, 1) }}%)"></div>
                                            </div>
                                            
                                        </div>
                                    @else
                                        <div class="text-center w-full">
                                            <span class="text-xs text-gray-500 italic">No tasks yet</span>
                                        </div>
                                    @endif
                                </td>

                                <td class="border-b border-gray-600 py-30 text-center w-32 whitespace-nowrap text-gray-300">
                                    {{ $project->created_at->format('M d, Y') }}
                                </td>
                                
                                <td class="border-b border-gray-600 py-30 text-center w-32 whitespace-nowrap">
                                    <div class="flex justify-center items-center space-x-4">
                                        <a href="{{ route('projects.tasks.index', $project) }}" class="text-green-400 hover:text-green-300 transition" title="Manage Tasks">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path></svg>
                                        </a>
                                        <a href="{{ route('projects.edit', $project) }}" class="text-indigo-400 hover:text-indigo-300 transition" title="Edit Project">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                        </a>
                                        <form action="{{ route('projects.destroy', $project) }}" method="POST" class="inline m-0 p-0">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-400 hover:text-red-300 focus:outline-none transition" title="Delete Project" onclick="return confirm('Are you sure you want to delete this project and all its tasks?')">
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-6 text-gray-400">No projects found. Create one to get started!</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>