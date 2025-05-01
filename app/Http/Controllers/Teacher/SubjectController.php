<?php

namespace App\Http\Controllers\Teacher;

use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class SubjectController extends Controller
{
    use AuthorizesRequests;
    
    public function index()
    {
        $user = User::find(Auth::id());
        $subjects = $user->teacherSubjects()->orderBy('name')->get();
        return view('teacher.subjects.index', compact('subjects'));
    }

    public function create()
    {
        return view('teacher.subjects.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|min:3',
            'description' => 'nullable',
            'code' => 'required|regex:/^IK-[A-Z]{3}[0-9]{3}$/',
            'credit' => 'required|numeric|min:1',
        ]);

        $validated['teacher_id'] = Auth::id();

        Subject::create($validated);

        return redirect()->route('teacher.subjects.index')
            ->with('success', 'Subject created successfully.');
    }

    public function show(Subject $subject)
    {
        $this->authorize('view', $subject);

        return view('teacher.subjects.show', compact('subject'));
    }

    public function edit(Subject $subject)
    {
        $this->authorize('update', $subject);

        return view('teacher.subjects.edit', compact('subject'));
    }

    public function update(Request $request, Subject $subject)
    {
        $this->authorize('update', $subject);

        $validated = $request->validate([
            'name' => 'required|min:3',
            'description' => 'nullable',
            'code' => 'required|regex:/^IK-[A-Z]{3}[0-9]{3}$/',
            'credit' => 'required|numeric|min:1',
        ]);

        $subject->update($validated);

        return redirect()->route('teacher.subjects.show', $subject)
            ->with('success', 'Subject updated successfully.');
    }

    public function destroy(Subject $subject)
    {
        $this->authorize('delete', $subject);

        $subject->delete();

        return redirect()->route('teacher.subjects.index')
            ->with('success', 'Subject deleted successfully.');
    }
}
