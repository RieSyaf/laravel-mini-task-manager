<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // 1. Get Total Projects
        $totalProjects = $user->projects()->count();

        // 2. Get User's Project IDs to securely fetch only their tasks
        $projectIds = $user->projects()->pluck('id');

        // 3. Get Task Metrics
        $totalTasks = Task::whereIn('project_id', $projectIds)->count();
        $tasksToDo = Task::whereIn('project_id', $projectIds)->where('status', 'To Do')->count();
        $tasksInProgress = Task::whereIn('project_id', $projectIds)->where('status', 'In Progress')->count();
        $tasksDone = Task::whereIn('project_id', $projectIds)->where('status', 'Done')->count();

        // 4. Get 10 Most Recently Edited/Created Projects
        $recentProjects = $user->projects()
            ->with('tasks')
            ->latest('updated_at') // Sorts by recently updated or created
            ->take(10)
            ->get();

        return view('dashboard', compact(
            'totalProjects', 
            'totalTasks', 
            'tasksToDo', 
            'tasksInProgress', 
            'tasksDone', 
            'recentProjects'
        ));
    }
}