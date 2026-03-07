<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div class="bg-[#1f2937] overflow-hidden rounded-lg shadow-lg text-white border-t-4 border-blue-500 p-6 text-center">
                    <div class="text-sm text-gray-400 font-bold uppercase tracking-wide">Total Projects</div>
                    <div class="text-3xl font-extrabold mt-2">{{ $totalProjects }}</div>
                </div>
                
                <div class="bg-[#1f2937] overflow-hidden rounded-lg shadow-lg text-white border-t-4 border-purple-500 p-6 text-center">
                    <div class="text-sm text-gray-400 font-bold uppercase tracking-wide">Total Tasks</div>
                    <div class="text-3xl font-extrabold mt-2">{{ $totalTasks }}</div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
                <div class="bg-[#1f2937] overflow-hidden rounded-lg shadow-lg text-white border-t-4 border-green-500 p-6 text-center">
                    <div class="text-sm text-gray-400 font-bold uppercase tracking-wide">Done</div>
                    <div class="text-3xl font-extrabold mt-2 text-green-400">{{ $tasksDone }}</div>
                </div>

                <div class="bg-[#1f2937] overflow-hidden rounded-lg shadow-lg text-white border-t-4 border-yellow-400 p-6 text-center">
                    <div class="text-sm text-gray-400 font-bold uppercase tracking-wide">In Progress</div>
                    <div class="text-3xl font-extrabold mt-2 text-yellow-400">{{ $tasksInProgress }}</div>
                </div>

                <div class="bg-[#1f2937] overflow-hidden rounded-lg shadow-lg text-white border-t-4 border-red-500 p-6 text-center">
                    <div class="text-sm text-gray-400 font-bold uppercase tracking-wide">To Do</div>
                    <div class="text-3xl font-extrabold mt-2 text-red-400">{{ $tasksToDo }}</div>
                </div>
            </div>

            <div class="flex justify-between items-end mb-4 px-2">
                <h3 class="text-lg font-bold text-white">Recently Updated Projects</h3>
                <a href="{{ route('projects.index') }}" class="text-white hover:text-blue-800 font-medium">View All Projects &rarr;</a>
            </div>

            <div class="bg-[#1f2937] overflow-hidden sm:rounded-lg p-6 shadow-lg text-white">
                @include('projects.partials.table', ['projects' => $recentProjects, 'isDashboard' => true])
            </div>
        </div>
    </div>
</x-app-layout>