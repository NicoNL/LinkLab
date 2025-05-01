<?php

namespace App\Policies;

use App\Models\Subject;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class SubjectPolicy
{

    public function viewAny(User $user): bool
    {
        return $user->isTeacher();
    }


    public function view(User $user, Subject $subject): bool
    {
        return $user->isTeacher() && $user->id === $subject->teacher_id;
    }

 
    public function create(User $user): bool
    {
        return $user->isTeacher();
    }

  
    public function update(User $user, Subject $subject): bool
    {
        return $user->isTeacher() && $user->id === $subject->teacher_id;
    }

 
    public function delete(User $user, Subject $subject): bool
    {
        return $user->isTeacher() && $user->id === $subject->teacher_id;
    }
    
    public function viewStudent(User $user, Subject $subject)
    {
        return $user->isStudent() && $user->studentSubjects->contains($subject);
    }

 
    public function restore(User $user, Subject $subject): bool
    {
        return false;
    }

   
    public function forceDelete(User $user, Subject $subject): bool
    {
        return false;
    }
}
