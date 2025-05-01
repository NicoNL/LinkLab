<?php

namespace App\Http\Controllers\Teacher;

use App\Models\Task;
use App\Models\Subject;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class TaskController extends Controller
{
    use AuthorizesRequests;

    public function createTask(Subject $subject)
    {
        $this->authorize('update', $subject);

        return view('teacher.tasks.create', compact('subject'));
    }
    public function storeTask(Request $request, Subject $subject)
    {
        $this->authorize('update', $subject);
        $validated = $request->validate([
            'name' => 'required|min:5',
            'description' => 'required',
            'points' => 'required|numeric|min:0',
        ]);
        $validated['subject_id'] = $subject->id;
        Task::create($validated);
        return redirect()->route('teacher.subjects.show', $subject)->with('success','Task created successfully');
    }
    public function showTask(Subject $subject, Task $task)
    {
        $this->authorize('view', $subject);

        return view('teacher.tasks.show', compact('subject', 'task'));
    }
    public function editTask(Subject $subject, Task $task)
    {
        $this->authorize('update', $subject);
        return view('teacher.tasks.edit', compact('subject', 'task'));    
    }
    public function updateTask(Request $request, Subject $subject, Task $task)
    {
        $this->authorize('update', $subject);
        $validated = $request->validate([
            'name'=>'required|min:3',
            'description' =>'required',
            'points' => 'required|numeric|min:0',
        ]);
        $task->update($validated);
        
        return redirect()->route('teacher.tasks.show', [$subject, $task])
            ->with('success','Task updated successfully');
    }

    public function destroyTask(Subject $subject, Task $task)
    {
        $this->authorize('update', $subject);
        
        $task->delete();
        
        return redirect()->route('teacher.subjects.show', $subject)
            ->with('success', 'Task deleted successfully.');
    }
}
