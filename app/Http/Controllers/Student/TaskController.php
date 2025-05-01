<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subject;
use App\Models\Task;
use App\Models\Solution;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Storage;

class TaskController extends Controller
{
    use AuthorizesRequests;
    
    public function show(Subject $subject, Task $task)
    {
        $this->authorize('viewStudent', $subject);
        
        $solution = Solution::where('task_id', $task->id)
            ->where('user_id', Auth::id())
            ->latest()
            ->first();
        
        return view('student.tasks.show', compact('subject', 'task', 'solution'));
    }
    
    public function submitTask(Request $request, Subject $subject, Task $task)
    {
        $this->authorize('viewStudent', $subject);
        
        $validated = $request->validate([
            'file' => 'required|file', 
        ]);
        
        $filePath = $request->file('file')->store('task-submissions', 'public');
        
        Solution::create([
            'content' => $filePath,
            'task_id' => $task->id,
            'user_id' => Auth::id(),
        ]);
        
        return redirect()->route('student.tasks.show', [$subject, $task])
            ->with('success', 'Solution submitted successfully.');
    }
}
