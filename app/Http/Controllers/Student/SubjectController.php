<?php

namespace App\Http\Controllers\Student;

use App\Models\User;
use App\Models\Subject;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class SubjectController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $user = User::find(Auth::id());
        $subjects = $user->studentSubjects()->orderBy('name')->get();
        return view('student.subjects.index', compact('subjects'));
    }

    public function available()
    {
        $user = User::find(Auth::id());
        $takenSubjectIds = $user->studentSubjects()->pluck('subjects.id');
        $availableSubjects = Subject::whereNotIn('id', $takenSubjectIds)->get();
        
        return view('student.subjects.available', compact('availableSubjects'));
    }

    public function take(Subject $subject)
    {
        $user = User::find(Auth::id());
        $user->studentSubjects()->attach($subject);
        
        return redirect()->route('student.subjects.index')
            ->with('success', 'Subject taken successfully.');
    }

    public function leave(Subject $subject)
    {
        $this->authorize('viewStudent', $subject);
        
        $user = User::find(Auth::id());
        $user->studentSubjects()->detach($subject);
        
        return redirect()->route('student.subjects.index')
            ->with('success', 'Subject left successfully.');
    }

    public function show(Subject $subject)
    {
        $this->authorize('viewStudent', $subject);
        
        $subject->load(['tasks' => function($query) {
            $query->with(['solutions' => function($query) {
                $query->where('user_id', Auth::id());
            }]);
        }]);
        
        return view('student.subjects.show', compact('subject'));
    }
}
