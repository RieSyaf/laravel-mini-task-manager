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

                @include('projects.partials.table', ['projects' => $projects, 'isDashboard' => false])
            </div>
        </div>
    </div>
</x-app-layout>