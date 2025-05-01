<?php

namespace App\Http\Controllers\Teacher;

use App\Models\Task;
use App\Models\Subject;
use App\Models\Solution;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class SolutionController extends Controller
{
    use AuthorizesRequests;

    public function evaluate(Subject $subject, Task $task, Solution $solution)
    {
        $this->authorize('view', $subject);

        return view('teacher.solutions.evaluate', compact('subject', 'task', 'solution'));
    }
    public function update(Request $request, Subject $subject, Task $task, Solution $solution)
    {
        $this->authorize('view', $subject);

        $validated = $request->validate([
            'points' => "required|numeric|min:0|max:{$task->points}",
        ]);

        // public function updatePoints($solution, $validated)
        // {
        //     $solution->update([
        //         'points' => $validated['points'],
        //         'evaluated_at' => now(),
        //     ]);
        // }
        DB::transaction(function () use ($solution, $validated) {
            $solution->update([
                'points' => $validated['points'],
                'evaluated_at' => now(),
            ]);
        });

        return redirect()->route('teacher.tasks.show', [$subject, $task])
            ->with('success', 'Solution evaluated successfully.');
    }

    public function download(Solution $solution)
    {
        $this->authorize('view', $solution->task->subject);
        
       
        return response()->streamDownload(function () use ($solution) {
            echo $solution->content;
        }, 'solution.txt');
    }

    public function gradeAll(Request $request, Subject $subject, Task $task)
    {
        $this->authorize('view', $subject);

        $validated = $request->validate([
            'grades' => 'required|array',
            'grades.*' => "nullable|numeric|min:0|max:{$task->points}",
        ]);

        foreach ($validated['grades'] as $solutionId => $points) {
            if ($points !== null) {
                $solution = Solution::find($solutionId);
                if ($solution && $solution->task_id === $task->id) {
                    $solution->update([
                        'points' => $points,
                        'evaluated_at' => now(),
                    ]);
                }
            }
        }

        return redirect()->route('teacher.tasks.show', [$subject, $task])
            ->with('success', 'All solutions have been graded successfully.');
    }
}
